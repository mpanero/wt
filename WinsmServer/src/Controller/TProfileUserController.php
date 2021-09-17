<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TProfileUser Controller
 *
 * @property \App\Model\Table\TProfileUserTable $TProfileUser
 *
 * @method \App\Model\Entity\TProfileUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TProfileUserController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $tProfileUser = $this->paginate($this->TProfileUser);

        $this->set(compact('tProfileUser'));
    }

    /**
     * View method
     *
     * @param string|null $id T Profile User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tProfileUser = $this->TProfileUser->get($id, [
            'contain' => []
        ]);

        $this->set('tProfileUser', $tProfileUser);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tProfileUser = $this->TProfileUser->newEntity();
        if ($this->request->is('post')) {
            $tProfileUser = $this->TProfileUser->patchEntity($tProfileUser, $this->request->getData());
            if ($this->TProfileUser->save($tProfileUser)) {
                $this->Flash->success(__('The t profile user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t profile user could not be saved. Please, try again.'));
        }
        $this->set(compact('tProfileUser'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Profile User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tProfileUser = $this->TProfileUser->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tProfileUser = $this->TProfileUser->patchEntity($tProfileUser, $this->request->getData());
            if ($this->TProfileUser->save($tProfileUser)) {
                $this->Flash->success(__('The t profile user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t profile user could not be saved. Please, try again.'));
        }
        $this->set(compact('tProfileUser'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Profile User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tProfileUser = $this->TProfileUser->get($id);
        if ($this->TProfileUser->delete($tProfileUser)) {
            $this->Flash->success(__('The t profile user has been deleted.'));
        } else {
            $this->Flash->error(__('The t profile user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
