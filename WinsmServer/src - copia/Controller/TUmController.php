<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TUm Controller
 *
 * @property \App\Model\Table\TUmTable $TUm
 *
 * @method \App\Model\Entity\TUm[] paginate($object = null, array $settings = [])
 */
class TUmController extends AppController
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
        $tUm = $this->paginate($this->TUm);

        $this->set(compact('tUm'));
    }

    /**
     * View method
     *
     * @param string|null $id T Um id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tUm = $this->TUm->get($id, [
            'contain' => []
        ]);

        $this->set('tUm', $tUm);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tUm = $this->TUm->newEntity();
        if ($this->request->is('post')) {
            $tUm = $this->TUm->patchEntity($tUm, $this->request->getData());
            if ($this->TUm->save($tUm)) {
                $this->Flash->success(__('The t um has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t um could not be saved. Please, try again.'));
        }
        $this->set(compact('tUm'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Um id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tUm = $this->TUm->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tUm = $this->TUm->patchEntity($tUm, $this->request->getData());
            if ($this->TUm->save($tUm)) {
                $this->Flash->success(__('The t um has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t um could not be saved. Please, try again.'));
        }
        $this->set(compact('tUm'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Um id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tUm = $this->TUm->get($id);
        if ($this->TUm->delete($tUm)) {
            $this->Flash->success(__('The t um has been deleted.'));
        } else {
            $this->Flash->error(__('The t um could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
