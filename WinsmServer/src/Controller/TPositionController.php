<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TPosition Controller
 *
 * @property \App\Model\Table\TPositionTable $TPosition
 *
 * @method \App\Model\Entity\TPosition[] paginate($object = null, array $settings = [])
 */
class TPositionController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		if($this->request->session()->check('Auth.TUser.token')){
            $this->Auth->allow(['index','find']);
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
        $tPosition = $this->paginate($this->TPosition);

        $this->set(compact('tPosition'));
    }

    /**
     * View method
     *
     * @param string|null $id T Position id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tPosition = $this->TPosition->get($id, [
            'contain' => []
        ]);

        $this->set('tPosition', $tPosition);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tPosition = $this->TPosition->newEntity();
        if ($this->request->is('post')) {
            $tPosition = $this->TPosition->patchEntity($tPosition, $this->request->getData());
            if ($this->TPosition->save($tPosition)) {
                $this->Flash->success(__('The t position has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t position could not be saved. Please, try again.'));
        }
        $this->set(compact('tPosition'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Position id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tPosition = $this->TPosition->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tPosition = $this->TPosition->patchEntity($tPosition, $this->request->getData());
            if ($this->TPosition->save($tPosition)) {
                $this->Flash->success(__('The t position has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t position could not be saved. Please, try again.'));
        }
        $this->set(compact('tPosition'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Position id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tPosition = $this->TPosition->get($id);
        if ($this->TPosition->delete($tPosition)) {
            $this->Flash->success(__('The t position has been deleted.'));
        } else {
            $this->Flash->error(__('The t position could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Find method
     *
     * @param string|null $id TPosition id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function find()
    {

        $tPosition = $this->TPosition->find('all', array(
                'order' => ['TPosition.DATE_POSITION' => 'ASC'],
                'conditions' => array('TPosition.ACTIVE' => 1
                ),
                'contain' => []

        ))
        ->select(['TPosition.ID_POSITION,',
        'TPosition.POSITION'
        ]);
        //debug($tPosition);
        $count = $tPosition->count();
        if($count > 0){// si existe tPosition    			 
            $this->set(compact('tPosition'));
            $this->set('_serialize', ['tPosition']);                
        }else{
            $data = "no data";
            $this->set('tPosition', $data);
            $this->set('_serialize', ['tPosition']); 
        }     

    }    
}
