<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TPlacesPrice Controller
 *
 * @property \App\Model\Table\TPlacesPriceTable $TPlacesPrice
 *
 * @method \App\Model\Entity\TPlacesPrice[] paginate($object = null, array $settings = [])
 */
class TPlacesPriceController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $tPlacesPrice = $this->paginate($this->TPlacesPrice);

        $this->set(compact('tPlacesPrice'));
    }

    /**
     * View method
     *
     * @param string|null $id T Places Price id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tPlacesPrice = $this->TPlacesPrice->get($id, [
            'contain' => []
        ]);

        $this->set('tPlacesPrice', $tPlacesPrice);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tPlacesPrice = $this->TPlacesPrice->newEntity();
        if ($this->request->is('post')) {
            $tPlacesPrice = $this->TPlacesPrice->patchEntity($tPlacesPrice, $this->request->getData());
            if ($this->TPlacesPrice->save($tPlacesPrice)) {
                $this->Flash->success(__('The t places price has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t places price could not be saved. Please, try again.'));
        }
        $this->set(compact('tPlacesPrice'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Places Price id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tPlacesPrice = $this->TPlacesPrice->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tPlacesPrice = $this->TPlacesPrice->patchEntity($tPlacesPrice, $this->request->getData());
            if ($this->TPlacesPrice->save($tPlacesPrice)) {
                $this->Flash->success(__('The t places price has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t places price could not be saved. Please, try again.'));
        }
        $this->set(compact('tPlacesPrice'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Places Price id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tPlacesPrice = $this->TPlacesPrice->get($id);
        if ($this->TPlacesPrice->delete($tPlacesPrice)) {
            $this->Flash->success(__('The t places price has been deleted.'));
        } else {
            $this->Flash->error(__('The t places price could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
