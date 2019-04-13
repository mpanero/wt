<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TTransac Controller
 *
 * @property \App\Model\Table\TTransacTable $TTransac
 *
 * @method \App\Model\Entity\TTransac[] paginate($object = null, array $settings = [])
 */
class TTransacController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $tTransac = $this->paginate($this->TTransac);

        $this->set(compact('tTransac'));
    }

    /**
     * View method
     *
     * @param string|null $id T Transac id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tTransac = $this->TTransac->get($id, [
            'contain' => []
        ]);

        $this->set('tTransac', $tTransac);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tTransac = $this->TTransac->newEntity();
        if ($this->request->is('post')) {
            $tTransac = $this->TTransac->patchEntity($tTransac, $this->request->getData());
            if ($this->TTransac->save($tTransac)) {
                $this->Flash->success(__('The t transac has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t transac could not be saved. Please, try again.'));
        }
        $this->set(compact('tTransac'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Transac id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tTransac = $this->TTransac->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tTransac = $this->TTransac->patchEntity($tTransac, $this->request->getData());
            if ($this->TTransac->save($tTransac)) {
                $this->Flash->success(__('The t transac has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t transac could not be saved. Please, try again.'));
        }
        $this->set(compact('tTransac'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Transac id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tTransac = $this->TTransac->get($id);
        if ($this->TTransac->delete($tTransac)) {
            $this->Flash->success(__('The t transac has been deleted.'));
        } else {
            $this->Flash->error(__('The t transac could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
