<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TUserRoles Controller
 *
 * @property \App\Model\Table\TUserRolesTable $TUserRoles
 *
 * @method \App\Model\Entity\TUserRole[] paginate($object = null, array $settings = [])
 */
class TUserRolesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $tUserRoles = $this->paginate($this->TUserRoles);

        $this->set(compact('tUserRoles'));
    }

    /**
     * View method
     *
     * @param string|null $id T User Role id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tUserRole = $this->TUserRoles->get($id, [
            'contain' => []
        ]);

        $this->set('tUserRole', $tUserRole);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tUserRole = $this->TUserRoles->newEntity();
        if ($this->request->is('post')) {
            $tUserRole = $this->TUserRoles->patchEntity($tUserRole, $this->request->getData());
            if ($this->TUserRoles->save($tUserRole)) {
                $this->Flash->success(__('The t user role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t user role could not be saved. Please, try again.'));
        }
        $this->set(compact('tUserRole'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T User Role id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tUserRole = $this->TUserRoles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tUserRole = $this->TUserRoles->patchEntity($tUserRole, $this->request->getData());
            if ($this->TUserRoles->save($tUserRole)) {
                $this->Flash->success(__('The t user role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t user role could not be saved. Please, try again.'));
        }
        $this->set(compact('tUserRole'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T User Role id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tUserRole = $this->TUserRoles->get($id);
        if ($this->TUserRoles->delete($tUserRole)) {
            $this->Flash->success(__('The t user role has been deleted.'));
        } else {
            $this->Flash->error(__('The t user role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
