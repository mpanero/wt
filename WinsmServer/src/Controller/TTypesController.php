<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TTypes Controller
 *
 * @property \App\Model\Table\TTypesTable $TTypes
 *
 * @method \App\Model\Entity\TType[] paginate($object = null, array $settings = [])
 */
class TTypesController extends AppController
{
	
	public function initialize()
	{
		parent::initialize();
		if($this->request->session()->check('Auth.TUser.token')){
            $this->Auth->allow(['find']);
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
        $tTypes = $this->paginate($this->TTypes);

        $this->set(compact('tTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id T Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tType = $this->TTypes->get($id, [
            'contain' => []
        ]);

        $this->set('tType', $tType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tType = $this->TTypes->newEntity();
        if ($this->request->is('post')) {
            $tType = $this->TTypes->patchEntity($tType, $this->request->getData());
            if ($this->TTypes->save($tType)) {
                $this->Flash->success(__('The t type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t type could not be saved. Please, try again.'));
        }
        $this->set(compact('tType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tType = $this->TTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tType = $this->TTypes->patchEntity($tType, $this->request->getData());
            if ($this->TTypes->save($tType)) {
                $this->Flash->success(__('The t type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t type could not be saved. Please, try again.'));
        }
        $this->set(compact('tType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tType = $this->TTypes->get($id);
        if ($this->TTypes->delete($tType)) {
            $this->Flash->success(__('The t type has been deleted.'));
        } else {
            $this->Flash->error(__('The t type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    /**
     * Find method
     *
     * @param string|null $type.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function find()
    {
    	$type = null;
    	if(!empty($this->request->query('type'))){
    		$type = $this->request->query('type');
    	}else{
    		if(!empty($this->request->query['type'])){
    			$type = $this->request->query['type'];
    		}
    	}
    	
    	if($type){
 
    		$tTypes = $this->TTypes->find('all', array(
    				'conditions' => array('TTypes.TYPE' => strtoupper($type),'TTypes.ACTIVE' => 1
    				)
    		));
    
    		$count = $tTypes->count();
    		if($count > 0){// si existe tipo
                $this->set(compact('tTypes'));
                $this->set('_serialize', ['tTypes']);      
    		}else{
    			$this->set('tTypes', "TypeNotExist");
    			$this->set('_serialize', ['tTypes']);
    		}
    
    	}else{
    		$this->set('tTypes', "TypeEmpty");
    		$this->set('_serialize', ['tTypes']);
    	}
    	
    }    
}
