<?php

declare(strict_types=1);

namespace App\Controller;

class RequestsController extends AppController
{
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $identity = $this->Authentication->getIdentity();
        if (!$identity || $identity->get('role') !== 'admin') {
            $this->Flash->error("Tu n’as pas accès à cette page.");
            return $this->redirect(['controller' => 'Artists', 'action' => 'index']);
        }

        $requests = $this->Requests->find('all')
            ->contain(['Users'])
            ->where(['Requests.status' => 'pending'])
            ->order(['Requests.created' => 'DESC'])
            ->all(); // ✅ ceci renvoie un ResultSet, compatible avec isEmpty()


        $this->set(compact('requests'));
    }

    public function accept($id = null)
    {
        $request = $this->Requests->get($id);
        $this->Authorization->authorize($request);

        $data = json_decode($request->content, true);

        if ($request->type === 'artist') {
            $artistTable = $this->fetchTable('Artists');

            $existingArtist = $artistTable->find()
                ->where(['name' => $data['name'] ?? ''])
                ->first();

            if (!$existingArtist) {
                $artist = $artistTable->newEmptyEntity();
                $artist = $artistTable->patchEntity($artist, [
                    'name' => $data['name'] ?? '',
                    'bio' => $data['bio'] ?? '',
                    'player' => $data['player'] ?? ''
                ]);

                if ($artistTable->save($artist)) {
                    $this->Flash->success("Artiste ajouté avec succès.");
                } else {
                    $this->Flash->error("Erreur lors de l'ajout de l'artiste.");
                    debug($artist->getErrors());
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                $this->Flash->info("L’artiste existe déjà.");
            }
        } elseif ($request->type === 'album') {
            $albumTable = $this->fetchTable('Albums');
            $artistTable = $this->fetchTable('Artists');

            $artistName = $data['artist_name'] ?? '';

            if (empty($artistName)) {
                $this->Flash->error("Le nom de l’artiste est requis pour ajouter l’album.");
                return $this->redirect(['action' => 'index']);
            }

            $artist = $artistTable->find()
                ->where(['name' => $artistName])
                ->first();

            if (!$artist) {
                $artist = $artistTable->newEmptyEntity();
                $artist = $artistTable->patchEntity($artist, [
                    'name' => $artistName,
                    'bio' => '',
                    'player' => ''
                ]);

                if (!$artistTable->save($artist)) {
                    $this->Flash->error("Erreur lors de l'ajout de l'artiste.");
                    debug($artist->getErrors());
                    return $this->redirect(['action' => 'index']);
                }
            }

            $album = $albumTable->newEmptyEntity();
            $album = $albumTable->patchEntity($album, [
                'title' => $data['title'] ?? '',
                'date_release' => $data['date_release'] ?? '',
                'player' => $data['player'] ?? '',
                'artist_id' => $artist->id ?? null
            ]);

            if ($albumTable->save($album)) {
                $this->Flash->success("Album ajouté avec succès.");
            } else {
                $this->Flash->error("Erreur lors de l'ajout de l'album.");
                debug($album->getErrors());
                return $this->redirect(['action' => 'index']);
            }
        }

        $request->status = 'accepted';
        $this->Requests->save($request);

        return $this->redirect(['action' => 'index']);
    }

    public function add()
    {
        $this->Authorization->skipAuthorization();
        $request = $this->Requests->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $content = [];

            if ($data['type'] === 'album') {
                $content = [
                    'title' => $data['content_name'] ?? '',
                    'player' => $data['player'] ?? '',
                    'date_release' => $data['date_release'] ?? '',
                    'artist_id' => $data['artist_id'] ?? null,
                    'artist_name' => $data['artist_name'] ?? '',
                ];
            } elseif ($data['type'] === 'artist') {
                $content = [
                    'name' => $data['content_name'] ?? '',
                    'bio' => $data['bio'] ?? '',
                    'player' => $data['player'] ?? '',
                ];
            }

            $requestData = [
                'type' => $data['type'],
                'content' => json_encode($content),
                'status' => 'pending',
                'user_id' => $this->Authentication->getIdentity()->get('id'),
            ];

            $request = $this->Requests->patchEntity($request, $requestData);

            if ($this->Requests->save($request)) {
                $this->Flash->success("Demande envoyée !");
                return $this->redirect(['controller' => 'Artists', 'action' => 'index']);
            }

            $this->Flash->error("Erreur lors de l'envoi.");
            debug($request->getErrors());
        }

        $artistsList = $this->fetchTable('Artists')
            ->find('list')
            ->order(['name' => 'ASC'])
            ->toArray();

        $this->set(compact('request', 'artistsList'));
    }


    public function myRequests()
    {
        $this->Authorization->skipAuthorization();

        $identity = $this->Authentication->getIdentity();
        if (!$identity) {
            $this->Flash->error("Connecte-toi d'abord.");
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        $requests = $this->Requests->find('all')
            ->where(['user_id' => $identity->get('id')])
            ->order(['Requests.created' => 'DESC'])
            ->all();

        $this->set(compact('requests'));
    }

    public function reject($id = null)
    {
        $request = $this->Requests->get($id);
        $this->Authorization->authorize($request);

        $request->status = 'rejected';

        if ($this->Requests->save($request)) {
            $this->Flash->success("La demande a été rejetée avec succès.");
        } else {
            $this->Flash->error("Erreur lors du rejet de la demande.");
        }

        return $this->redirect(['action' => 'index']);
    }
}
