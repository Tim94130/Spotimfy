<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Favorites Controller
 *
 * @property \App\Model\Table\FavoritesTable $Favorites
 */
class FavoritesController extends AppController
{
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $favorites = $this->Favorites->find()
            ->contain(['Users', 'Albums', 'Artists'])
            ->where(['Favorites.user_id' => $this->request->getAttribute('identity')->id]);

        $this->set(compact('favorites'));
    }

    public function view($id = null)
    {
        $album = $this->Albums->get($id, [
            'contain' => ['Artists', 'Favorites'],
        ]);

        $this->Authorization->authorize($album); // ← vérifie l'accès à l'entité

        $this->set(compact('album'));
    }


    public function add()
    {
        $favorite = $this->Favorites->newEmptyEntity();
        $this->Authorization->authorize($favorite);

        if ($this->request->is('post')) {
            $favorite = $this->Favorites->patchEntity($favorite, $this->request->getData());

            // Si pas d'utilisateur spécifié, on utilise celui connecté
            if (!$favorite->user_id) {
                $favorite->user_id = $this->request->getAttribute('identity')->id;
            }

            if ($this->Favorites->save($favorite)) {
                $this->Flash->success(__('Favori ajouté avec succès.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Impossible d\'ajouter le favori.'));
        }

        $users = $this->Favorites->Users->find('list')->all();
        $albums = $this->Favorites->Albums->find('list')->all();
        $artists = $this->Favorites->Artists->find('list')->all();
        $this->set(compact('favorite', 'users', 'albums', 'artists'));
    }

    public function edit($id = null)
    {
        $favorite = $this->Favorites->get($id);
        $this->Authorization->authorize($favorite);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $favorite = $this->Favorites->patchEntity($favorite, $this->request->getData());
            if ($this->Favorites->save($favorite)) {
                $this->Flash->success(__('Le favori a été modifié.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erreur lors de la modification.'));
        }

        $users = $this->Favorites->Users->find('list')->all();
        $albums = $this->Favorites->Albums->find('list')->all();
        $artists = $this->Favorites->Artists->find('list')->all();
        $this->set(compact('favorite', 'users', 'albums', 'artists'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $favorite = $this->Favorites->get($id);
        $this->Authorization->authorize($favorite);

        if ($this->Favorites->delete($favorite)) {
            $this->Flash->success(__('Favori supprimé.'));
        } else {
            $this->Flash->error(__('Impossible de supprimer le favori.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function toggle($type, $id)
    {
        $this->Authorization->skipAuthorization();

        $userId = $this->request->getAttribute('identity')->id;

        $conditions = ['user_id' => $userId];
        if ($type === 'artist') {
            $conditions['artist_id'] = $id;
        } elseif ($type === 'album') {
            $conditions['album_id'] = $id;
        } else {
            $this->Flash->error('Type invalide.');
            return $this->redirect($this->referer());
        }

        $exists = $this->Favorites->find()->where($conditions)->first();

        if ($exists) {
            $this->Favorites->delete($exists);
            $this->Flash->success(ucfirst($type) . ' retiré des favoris.');
        } else {
            $favorite = $this->Favorites->newEmptyEntity();
            $favorite->user_id = $userId;
            if ($type === 'artist') {
                $favorite->artist_id = $id;
            } else {
                $favorite->album_id = $id;
            }
            $this->Favorites->save($favorite);
            $this->Flash->success(ucfirst($type) . ' ajouté aux favoris.');
        }

        return $this->redirect(['controller' => ucfirst($type . 's'), 'action' => 'view', $id]);
    }
}
