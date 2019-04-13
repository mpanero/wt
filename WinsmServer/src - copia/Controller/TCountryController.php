<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TCountry Controller
 *
 * @property \App\Model\Table\TCountryTable $TCountry
 *
 * @method \App\Model\Entity\TCountry[] paginate($object = null, array $settings = [])
 */
class TCountryController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $tCountry = $this->paginate($this->TCountry);

        $this->set(compact('tCountry'));
    }

    /**
     * View method
     *
     * @param string|null $id T Country id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tCountry = $this->TCountry->get($id, [
            'contain' => []
        ]);

        $this->set('tCountry', $tCountry);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tCountry = $this->TCountry->newEntity();
        if ($this->request->is('post')) {
            $tCountry = $this->TCountry->patchEntity($tCountry, $this->request->getData());
            if ($this->TCountry->save($tCountry)) {
                $this->Flash->success(__('The t country has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t country could not be saved. Please, try again.'));
        }
        $this->set(compact('tCountry'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Country id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tCountry = $this->TCountry->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tCountry = $this->TCountry->patchEntity($tCountry, $this->request->getData());
            if ($this->TCountry->save($tCountry)) {
                $this->Flash->success(__('The t country has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t country could not be saved. Please, try again.'));
        }
        $this->set(compact('tCountry'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Country id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tCountry = $this->TCountry->get($id);
        if ($this->TCountry->delete($tCountry)) {
            $this->Flash->success(__('The t country has been deleted.'));
        } else {
            $this->Flash->error(__('The t country could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
