<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TUserVendors Controller
 *
 * @property \App\Model\Table\TUserVendorsTable $TUserVendors
 *
 * @method \App\Model\Entity\TUserVendor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TUserVendorsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $tUserVendors = $this->paginate($this->TUserVendors);

        $this->set(compact('tUserVendors'));
    }

    /**
     * View method
     *
     * @param string|null $id T User Vendor id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tUserVendor = $this->TUserVendors->get($id, [
            'contain' => []
        ]);

        $this->set('tUserVendor', $tUserVendor);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tUserVendor = $this->TUserVendors->newEntity();
        if ($this->request->is('post')) {
            $tUserVendor = $this->TUserVendors->patchEntity($tUserVendor, $this->request->getData());
            if ($this->TUserVendors->save($tUserVendor)) {
                $this->Flash->success(__('The t user vendor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t user vendor could not be saved. Please, try again.'));
        }
        $this->set(compact('tUserVendor'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T User Vendor id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tUserVendor = $this->TUserVendors->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tUserVendor = $this->TUserVendors->patchEntity($tUserVendor, $this->request->getData());
            if ($this->TUserVendors->save($tUserVendor)) {
                $this->Flash->success(__('The t user vendor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t user vendor could not be saved. Please, try again.'));
        }
        $this->set(compact('tUserVendor'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T User Vendor id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tUserVendor = $this->TUserVendors->get($id);
        if ($this->TUserVendors->delete($tUserVendor)) {
            $this->Flash->success(__('The t user vendor has been deleted.'));
        } else {
            $this->Flash->error(__('The t user vendor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
