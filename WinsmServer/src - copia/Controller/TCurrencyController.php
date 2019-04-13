<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TCurrency Controller
 *
 * @property \App\Model\Table\TCurrencyTable $TCurrency
 *
 * @method \App\Model\Entity\TCurrency[] paginate($object = null, array $settings = [])
 */
class TCurrencyController extends AppController
{
	
	public function initialize()
	{
		parent::initialize();
		if($this->request->session()->check('Auth.TUser.token')){
            $this->Auth->allow(['index']);
			return true;
		}
	}     

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $tCurrency = $this->paginate($this->TCurrency);

        $this->set(compact('tCurrency'));
    }

    /**
     * View method
     *
     * @param string|null $id T Currency id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tCurrency = $this->TCurrency->get($id, [
            'contain' => []
        ]);

        $this->set('tCurrency', $tCurrency);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tCurrency = $this->TCurrency->newEntity();
        if ($this->request->is('post')) {
            $tCurrency = $this->TCurrency->patchEntity($tCurrency, $this->request->getData());
            if ($this->TCurrency->save($tCurrency)) {
                $this->Flash->success(__('The t currency has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t currency could not be saved. Please, try again.'));
        }
        $this->set(compact('tCurrency'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Currency id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tCurrency = $this->TCurrency->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tCurrency = $this->TCurrency->patchEntity($tCurrency, $this->request->getData());
            if ($this->TCurrency->save($tCurrency)) {
                $this->Flash->success(__('The t currency has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t currency could not be saved. Please, try again.'));
        }
        $this->set(compact('tCurrency'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Currency id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tCurrency = $this->TCurrency->get($id);
        if ($this->TCurrency->delete($tCurrency)) {
            $this->Flash->success(__('The t currency has been deleted.'));
        } else {
            $this->Flash->error(__('The t currency could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
