<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TProductsRel Controller
 *
 * @property \App\Model\Table\TProductsRelTable $TProductsRel
 *
 * @method \App\Model\Entity\TProductsRel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TProductsRelController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $tProductsRel = $this->paginate($this->TProductsRel);

        $this->set(compact('tProductsRel'));
    }

    /**
     * View method
     *
     * @param string|null $id T Products Rel id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tProductsRel = $this->TProductsRel->get($id, [
            'contain' => []
        ]);

        $this->set('tProductsRel', $tProductsRel);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tProductsRel = $this->TProductsRel->newEntity();
        if ($this->request->is('post')) {
            $tProductsRel = $this->TProductsRel->patchEntity($tProductsRel, $this->request->getData());
            if ($this->TProductsRel->save($tProductsRel)) {
                $this->Flash->success(__('The t products rel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t products rel could not be saved. Please, try again.'));
        }
        $this->set(compact('tProductsRel'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Products Rel id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tProductsRel = $this->TProductsRel->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tProductsRel = $this->TProductsRel->patchEntity($tProductsRel, $this->request->getData());
            if ($this->TProductsRel->save($tProductsRel)) {
                $this->Flash->success(__('The t products rel has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t products rel could not be saved. Please, try again.'));
        }
        $this->set(compact('tProductsRel'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Products Rel id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tProductsRel = $this->TProductsRel->get($id);
        if ($this->TProductsRel->delete($tProductsRel)) {
            $this->Flash->success(__('The t products rel has been deleted.'));
        } else {
            $this->Flash->error(__('The t products rel could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
