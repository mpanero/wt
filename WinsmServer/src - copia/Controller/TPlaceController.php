<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TPlace Controller
 *
 * @property \App\Model\Table\TPlaceTable $TPlace
 *
 * @method \App\Model\Entity\TPlace[] paginate($object = null, array $settings = [])
 */
class TPlaceController extends AppController
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
        
        $tPlace = $this->paginate($this->TPlace);

        $this->set(compact('tPlace'));
    }

    /**
     * View method
     *
     * @param string|null $id T Place id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tPlace = $this->TPlace->get($id, [
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
        $tPlace = $this->TPlace->newEntity();
        if ($this->request->is('post')) {
            $tPlace = $this->TPlace->patchEntity($tPlace, $this->request->getData());
            if ($this->TPlace->save($tPlace)) {
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
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tPlace = $this->TPlace->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tPlace = $this->TPlace->patchEntity($tPlace, $this->request->getData());
            if ($this->TPlace->save($tPlace)) {
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
        $tPlace = $this->TPlace->get($id);
        if ($this->TPlace->delete($tPlace)) {
            $this->Flash->success(__('The t place has been deleted.'));
        } else {
            $this->Flash->error(__('The t place could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
