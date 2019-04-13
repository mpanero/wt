<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TTypeActivity Controller
 *
 * @property \App\Model\Table\TTypeActivityTable $TTypeActivity
 *
 * @method \App\Model\Entity\TTypeActivity[] paginate($object = null, array $settings = [])
 */
class TTypeActivityController extends AppController
{
	
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['index']);
		if($this->request->session()->check("Auth.TUser")){
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
        $tTypeActivity = $this->paginate($this->TTypeActivity);

        $this->set(compact('tTypeActivity'));
    }

    /**
     * View method
     *
     * @param string|null $id T Type Activity id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tTypeActivity = $this->TTypeActivity->get($id, [
            'contain' => []
        ]);

        $this->set('tTypeActivity', $tTypeActivity);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tTypeActivity = $this->TTypeActivity->newEntity();
        if ($this->request->is('post')) {
            $tTypeActivity = $this->TTypeActivity->patchEntity($tTypeActivity, $this->request->getData());
            if ($this->TTypeActivity->save($tTypeActivity)) {
                $this->Flash->success(__('The t type activity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t type activity could not be saved. Please, try again.'));
        }
        $this->set(compact('tTypeActivity'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Type Activity id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tTypeActivity = $this->TTypeActivity->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tTypeActivity = $this->TTypeActivity->patchEntity($tTypeActivity, $this->request->getData());
            if ($this->TTypeActivity->save($tTypeActivity)) {
                $this->Flash->success(__('The t type activity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t type activity could not be saved. Please, try again.'));
        }
        $this->set(compact('tTypeActivity'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Type Activity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tTypeActivity = $this->TTypeActivity->get($id);
        if ($this->TTypeActivity->delete($tTypeActivity)) {
            $this->Flash->success(__('The t type activity has been deleted.'));
        } else {
            $this->Flash->error(__('The t type activity could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
