<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TPlaces Controller
 *
 * @property \App\Model\Table\TPlacesTable $TPlaces
 *
 * @method \App\Model\Entity\TPlace[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TPlacesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $tPlaces = $this->paginate($this->TPlaces);

        $this->set(compact('tPlaces'));
    }

    /**
     * View method
     *
     * @param string|null $id T Place id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tPlace = $this->TPlaces->get($id, [
            'contain' => []
        ]);

        $this->set('tPlace', $tPlace);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tPlace = $this->TPlaces->newEntity();
        if ($this->request->is('post')) {
            $tPlace = $this->TPlaces->patchEntity($tPlace, $this->request->getData());
            if ($this->TPlaces->save($tPlace)) {
                $this->Flash->success(__('The t place has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t place could not be saved. Please, try again.'));
        }
        $this->set(compact('tPlace'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Place id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tPlace = $this->TPlaces->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tPlace = $this->TPlaces->patchEntity($tPlace, $this->request->getData());
            if ($this->TPlaces->save($tPlace)) {
                $this->Flash->success(__('The t place has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t place could not be saved. Please, try again.'));
        }
        $this->set(compact('tPlace'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Place id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tPlace = $this->TPlaces->get($id);
        if ($this->TPlaces->delete($tPlace)) {
            $this->Flash->success(__('The t place has been deleted.'));
        } else {
            $this->Flash->error(__('The t place could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
