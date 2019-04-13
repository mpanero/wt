<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TAlarms Controller
 *
 * @property \App\Model\Table\TAlarmsTable $TAlarms
 *
 * @method \App\Model\Entity\TAlarms[] paginate($object = null, array $settings = [])
 */
class TAlarmsController extends AppController
{
    public function initialize()
	{
		parent::initialize();	
		if($this->request->session()->check('Auth.TUser.token')){
            $this->Auth->allow(['newAlarm','find','editAlarm','deleteAlarm']);
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
        $tAlarms = $this->paginate($this->TAlarms);

        $this->set(compact('tAlarms'));
    }

    /**
     * View method
     *
     * @param string|null $id T Alarm id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tAlarm = $this->TAlarms->get($id, [
            'contain' => []
        ]);

        $this->set('tAlarm', $tAlarm);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tAlarm = $this->TAlarms->newEntity();
        if ($this->request->is('post')) {
            $tAlarm = $this->TAlarms->patchEntity($tAlarm, $this->request->getData());
            if ($this->TAlarms->save($tAlarm)) {
                $this->Flash->success(__('The t alarm has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t alarm could not be saved. Please, try again.'));
        }
        $this->set(compact('tAlarm'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Alarm id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tAlarm = $this->TAlarms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tAlarm = $this->TAlarms->patchEntity($tAlarm, $this->request->getData());
            if ($this->TAlarms->save($tAlarm)) {
                $this->Flash->success(__('The t alarm has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t alarm could not be saved. Please, try again.'));
        }
        $this->set(compact('tAlarm'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Alarm id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tAlarm = $this->TAlarms->get($id);
        if ($this->TAlarms->delete($tAlarm)) {
            $this->Flash->success(__('The t alarm has been deleted.'));
        } else {
            $this->Flash->error(__('The t alarm could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function newAlarm()
    {
        $tAlarm = $this->TAlarms->newEntity();
        //if ($this->request->is('post')) {
            //var_dump($this->request->query);
            //$tAlarm = $this->TAlarms->patchEntity($tAlarm, $this->request->query);
            $tAlarm = $this->TAlarms->newEntity();
            $newObjeto = [];
            foreach ($this->request->query as $key => $value) {
                # code...
                //$newObjeto[$key] = $value;
                $tAlarm->$key = $value;
            }              
            $tAlarm->ACTIVE = 1;
            //var_dump($tAlarm);
            if ($this->TAlarms->save($tAlarm)) {
                //debug($tAlarm);
                //var_dump($this->TAlarms->getDataSource()->showLog());
                $this->set(compact('tAlarm'));
                $this->set('_serialize', ['tAlarm']);
            }else{
                $tAlarm = "no save";
            }
            
            $this->Flash->error(__('The t request could not be saved. Please, try again.'));
            $this->set('tAlarm', $tAlarm);
            $this->set('_serialize', ['tAlarm']);
        //}
    }

    /**
     * Find method
     *
     * @param string|null $id TAlarms id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function find()
    {
    	$user = null;
    	if(!empty($this->request->query('user'))){
    		$user = $this->request->query('user');
    	}else{
    		if(!empty($this->request->query['user'])){
    			$user = $this->request->query['user'];
    		}
        } 
      
        if($user){
    		$tAlarm = $this->TAlarms->find('all', array(
                    'order' => ['TAlarms.ID_ALARM' => 'DESC'],
                    'conditions' => array('TAlarms.ID_USER' => $user,
    					'TAlarms.ACTIVE' => 1
    				),
                    'contain' => ['TMarket', 'TProduct', 'TUser', 'TTypes']

            ));
            //debug($tAlarm);
    		$count = $tAlarm->count();
    		if($count > 0){// si existe tAlarm    			 
                $this->set(compact('tAlarm'));
                $this->set('_serialize', ['tAlarm']);                
            }else{
                $data = "no data";
                $this->set('tAlarm', $data);
                $this->set('_serialize', ['tAlarm']); 
            }     

        }else{
            $data = "null params";
            $this->set('tAlarm', $data);
            $this->set('_serialize', ['tAlarm']);
        }
    }

    /**
     * Edit method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function editAlarm()
    {
    	$id = null;
    	if(!empty($this->request->query('ID_ALARM'))){
    		$id = $this->request->query('ID_ALARM');
    	}else{
    		if(!empty($this->request->query['ID_ALARM'])){
    			$id = $this->request->query['ID_ALARM'];
    		}else{
                if(!empty($this->request->data['ID_ALARM'])){
                    $id = $this->request->data['ID_ALARM'];
                }else{
                    if(!empty($this->request->data('ID_ALARM'))){
                        $id = $this->request->data('ID_ALARM');
                    }
                }
            }
        }

        $tAlarm = $this->TAlarms->get($id, [
            'contain' => ['TMarket', 'TProduct', 'TUser', 'TTypes']
        ]);
        $tAlarm = $this->TAlarms->newEntity();
        $newObjeto = [];
        foreach ($this->request->query as $key => $value) {
            # code...
            //$newObjeto[$key] = $value;
            $tAlarm->$key = $value;
        }        
      
        //debug($tAlarm);
        if ($this->TAlarms->save($tAlarm)) {
            $tAlarm = $this->TAlarms->get($id, [
                'contain' => ['TMarket', 'TProduct', 'TUser', 'TTypes']
            ]);            
            $this->set(compact('tAlarm'));
            $this->set('_serialize', ['tAlarm']);
        }else{
            $tAlarm = "no update";
        }
        $this->set('tAlarm', $tAlarm);
        $this->set('_serialize', ['tAlarm']);
    
    }

    /**
     * Delete method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function deleteAlarm()
    {
        $id = null;
        if(!empty($this->request->query('ID_ALARM'))){
    		$id = $this->request->query('ID_ALARM');
    	}else{
    		if(!empty($this->request->query['ID_ALARM'])){
    			$id = $this->request->query['ID_ALARM'];
    		}else{
                if(!empty($this->request->data['ID_ALARM'])){
                    $id = $this->request->data['ID_ALARM'];
                }else{
                    if(!empty($this->request->data('ID_ALARM'))){
                        $id = $this->request->data('ID_ALARM');
                    }
                }
            }
        }

        $tAlarm = $this->TAlarms->get($id, [
            'contain' => []
        ]);
        $tAlarm = $this->TAlarms->patchEntity($tAlarm, $this->request->data);
        $tAlarm->ACTIVE = 0;
        if ($this->TAlarms->save($tAlarm)) {
            $this->set(compact('tAlarm'));
            $this->set('_serialize', ['tAlarm']);
        }else{
            $tAlarm = "no delete";
        }
        $this->set('tAlarm', $tAlarm);
        $this->set('_serialize', ['tAlarm']);
    
    }      
    
}
