<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TTransacType Controller
 *
 * @property \App\Model\Table\TTransacTypeTable $TTransacType
 *
 * @method \App\Model\Entity\TTransacType[] paginate($object = null, array $settings = [])
 */
class TTransacTypeController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $tTransacType = $this->paginate($this->TTransacType);

        $this->set(compact('tTransacType'));
    }

    /**
     * View method
     *
     * @param string|null $id T Transac Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tTransacType = $this->TTransacType->get($id, [
            'contain' => []
        ]);

        $this->set('tTransacType', $tTransacType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tTransacType = $this->TTransacType->newEntity();
        if ($this->request->is('post')) {
            $tTransacType = $this->TTransacType->patchEntity($tTransacType, $this->request->getData());
            if ($this->TTransacType->save($tTransacType)) {
                $this->Flash->success(__('The t transac type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t transac type could not be saved. Please, try again.'));
        }
        $this->set(compact('tTransacType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Transac Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tTransacType = $this->TTransacType->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tTransacType = $this->TTransacType->patchEntity($tTransacType, $this->request->getData());
            if ($this->TTransacType->save($tTransacType)) {
                $this->Flash->success(__('The t transac type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t transac type could not be saved. Please, try again.'));
        }
        $this->set(compact('tTransacType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Transac Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tTransacType = $this->TTransacType->get($id);
        if ($this->TTransacType->delete($tTransacType)) {
            $this->Flash->success(__('The t transac type has been deleted.'));
        } else {
            $this->Flash->error(__('The t transac type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
