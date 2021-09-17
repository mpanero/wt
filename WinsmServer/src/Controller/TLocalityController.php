<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Error\Debugger;
use Cake\Datasource;
use Cake\Core\StaticConfigTrait;
use Cake\I18n\Time;
use Cake\I18n\Date;
/**
 * TLocality Controller
 *
 * @property \App\Model\Table\TLocalityTable $TLocality
 *
 * @method \App\Model\Entity\TLocality[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TLocalityController extends AppController
{
	
	public function initialize()
	{
        parent::initialize();
		if($this->request->session()->read('Auth.TUser.token')){
            $this->Auth->allow(['view', 'add', 'edit','delete']);
			return true;
        }else{
            $this->Auth->allow(['find','load']); //El uso de AuthComponent estándar permite que la lógica permita el acceso no autenticado a las acciones / add y / token
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
        $tLocality = $this->paginate($this->TLocality);

        $this->set(compact('tLocality'));
    }

    /**
     * View method
     *
     * @param string|null $id T Locality id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tLocality = $this->TLocality->get($id, [
            'contain' => []
        ]);

        $this->set('tLocality', $tLocality);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tLocality = $this->TLocality->newEntity();
        if ($this->request->is('post')) {
            $tLocality = $this->TLocality->patchEntity($tLocality, $this->request->getData());
            if ($this->TLocality->save($tLocality)) {
                $this->Flash->success(__('The t locality has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t locality could not be saved. Please, try again.'));
        }
        $this->set(compact('tLocality'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Locality id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tLocality = $this->TLocality->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tLocality = $this->TLocality->patchEntity($tLocality, $this->request->getData());
            if ($this->TLocality->save($tLocality)) {
                $this->Flash->success(__('The t locality has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t locality could not be saved. Please, try again.'));
        }
        $this->set(compact('tLocality'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Locality id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tLocality = $this->TLocality->get($id);
        if ($this->TLocality->delete($tLocality)) {
            $this->Flash->success(__('The t locality has been deleted.'));
        } else {
            $this->Flash->error(__('The t locality could not be deleted. Please, try again.'));
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
    	$provi = null;
    	if(!empty($this->request->query('provi'))){
    		$provi = $this->request->query('provi');
    	}else{
    		if(!empty($this->request->query['provi'])){
    			$provi = $this->request->query['provi'];
    		}
    	}
    	
    	if($provi){
 
    		$tLocality = $this->TLocality->find('all', array(
    				'conditions' => array('TLocality.ID_PROVINCE' => $provi)
    		));
    
    		$count = $tLocality->count();
    		if($count > 0){// si existe tipo
                $this->set(compact('tLocality'));
                $this->set('_serialize', ['tLocality']);      
    		}else{
    			$this->set('tLocality', "Privincia No Existe");
    			$this->set('_serialize', ['tLocality']);
    		}
    
    	}else{
    		$this->set('tLocality', "Filtro Vacio");
    		$this->set('_serialize', ['tLocality']);
    	}
    	
    }  


    /**
     * Edit method
     *
     * @param string|null $id T Locality id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function load()
    {
        $id = null;
    	if(!empty($this->request->query('loc'))){
    		$id = $this->request->query('loc');
    	}else{
    		if(!empty($this->request->query['loc'])){
    			$id = $this->request->query['loc'];
    		}
        }
        
        if($id){

            $tLocality = TableRegistry::get('TLocality')->find('all', array(
                'conditions' => array('TLocality.ID_PLACE' => $id)
            ));

    		$count = $tLocality->count();
    		if($count > 0){// si existe tipo
                $this->set(compact('tLocality'));
                $this->set('_serialize', ['tLocality']);      
    		}else{
    			$this->set('tLocality', "Localidad No Existe");
    			$this->set('_serialize', ['tLocality']);
            }
            
        }else{
    		$this->set('tLocality', "Filtro Vacio");
    		$this->set('_serialize', ['tLocality']);
    	}
    }

}
