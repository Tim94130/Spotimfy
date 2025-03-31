<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Albums Controller
 *
 * @property \App\Model\Table\AlbumsTable $Albums
 */
class AlbumsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization(); // si tu utilises Authorization

        $albums = $this->Albums->find('all')->contain(['Artists'])->all();

        $this->set(compact('albums'));
    }


    /**
     * View method
     *
     * @param string|null $id Album id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $album = $this->Albums->get($id, [
            'contain' => ['Artists', 'Favorites'],
        ]);

        $this->Authorization->authorize($album); // 🔐 obligatoire !

        $this->set(compact('album'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $album = $this->Albums->newEmptyEntity();
        $this->Authorization->authorize($album); // 🔐 indispensable

        if ($this->request->is('post')) {
            $album = $this->Albums->patchEntity($album, $this->request->getData());
            if ($this->Albums->save($album)) {
                $this->Flash->success(__('Album ajouté avec succès.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erreur lors de l\'ajout de l\'album.'));
        }

        $artists = $this->Albums->Artists->find('list')->order(['name' => 'ASC'])->all();
        $this->set(compact('album', 'artists'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Album id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $album = $this->Albums->get($id, [
            'contain' => [],
        ]);

        // 🔐 Autorisation obligatoire
        $this->Authorization->authorize($album);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $album = $this->Albums->patchEntity($album, $this->request->getData());
            if ($this->Albums->save($album)) {
                $this->Flash->success(__('Album modifié avec succès.'));

                return $this->redirect(['action' => 'view', $album->id]);
            }
            $this->Flash->error(__('Impossible de modifier l’album.'));
        }
        $artists = $this->Albums->Artists->find('list', ['limit' => 200])->all();
        $this->set(compact('album', 'artists'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Album id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $album = $this->Albums->get($id);
        if ($this->Albums->delete($album)) {
            $this->Flash->success(__('The album has been deleted.'));
        } else {
            $this->Flash->error(__('The album could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
