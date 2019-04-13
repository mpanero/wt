<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TPrices Controller
 *
 * @property \App\Model\Table\TPricesTable $TPrices
 *
 * @method \App\Model\Entity\TPrice[] paginate($object = null, array $settings = [])
 */
class TPricesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $tPrices = $this->paginate($this->TPrices);

        $this->set(compact('tPrices'));
    }

    /**
     * View method
     *
     * @param string|null $id T Price id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tPrice = $this->TPrices->get($id, [
            'contain' => []
        ]);

        $this->set('tPrice', $tPrice);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tPrice = $this->TPrices->newEntity();
        if ($this->request->is('post')) {
            $tPrice = $this->TPrices->patchEntity($tPrice, $this->request->getData());
            if ($this->TPrices->save($tPrice)) {
                $this->Flash->success(__('The t price has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t price could not be saved. Please, try again.'));
        }
        $this->set(compact('tPrice'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Price id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tPrice = $this->TPrices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tPrice = $this->TPrices->patchEntity($tPrice, $this->request->getData());
            if ($this->TPrices->save($tPrice)) {
                $this->Flash->success(__('The t price has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t price could not be saved. Please, try again.'));
        }
        $this->set(compact('tPrice'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Price id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tPrice = $this->TPrices->get($id);
        if ($this->TPrices->delete($tPrice)) {
            $this->Flash->success(__('The t price has been deleted.'));
        } else {
            $this->Flash->error(__('The t price could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
