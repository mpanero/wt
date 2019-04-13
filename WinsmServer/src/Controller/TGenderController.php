<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TGender Controller
 *
 * @property \App\Model\Table\TGenderTable $TGender
 *
 * @method \App\Model\Entity\TGender[] paginate($object = null, array $settings = [])
 */
class TGenderController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['index']);
		if($this->request->session()->check("Auth.TUser.token")){
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
        $tGender = $this->paginate($this->TGender);

        $this->set(compact('tGender'));
    }

    /**
     * View method
     *
     * @param string|null $id T Gender id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tGender = $this->TGender->get($id, [
            'contain' => []
        ]);

        $this->set('tGender', $tGender);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tGender = $this->TGender->newEntity();
        if ($this->request->is('post')) {
            $tGender = $this->TGender->patchEntity($tGender, $this->request->getData());
            if ($this->TGender->save($tGender)) {
                $this->Flash->success(__('The t gender has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t gender could not be saved. Please, try again.'));
        }
        $this->set(compact('tGender'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Gender id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tGender = $this->TGender->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tGender = $this->TGender->patchEntity($tGender, $this->request->getData());
            if ($this->TGender->save($tGender)) {
                $this->Flash->success(__('The t gender has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t gender could not be saved. Please, try again.'));
        }
        $this->set(compact('tGender'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Gender id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tGender = $this->TGender->get($id);
        if ($this->TGender->delete($tGender)) {
            $this->Flash->success(__('The t gender has been deleted.'));
        } else {
            $this->Flash->error(__('The t gender could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
