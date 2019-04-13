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
 * TRequest Controller
 *
 * @property \App\Model\Table\TRequestTable $TRequest
 */
class TRequestController extends AppController
{

	public function initialize()
	{
        parent::initialize();
		if($this->request->session()->read('Auth.TUser.token')){
            $this->Auth->allow(['newRequest','find','editRequest','deleteRequest','filter','page','filterPage','resumen']);
			return true;
        }
        
	}    
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $tRequest = $this->paginate($this->TRequest);

        $this->set(compact('tRequest'));
        $this->set('_serialize', ['tRequest']);
    }

    /**
     * View method
     *
     * @param string|null $id T Request id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tRequest = $this->TRequest->get($id, [
            'contain' => []
        ]);

        $this->set('tRequest', $tRequest);
        $this->set('_serialize', ['tRequest']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tRequest = $this->TRequest->newEntity();
        if ($this->request->is('post')) {
            $tRequest = $this->TRequest->patchEntity($tRequest, $this->request->data);
            if ($this->TRequest->save($tRequest)) {
                $this->Flash->success(__('The t request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t request could not be saved. Please, try again.'));
            $this->set(compact('tRequest'));
            $this->set('_serialize', ['tRequest']);
        }
        $this->set(compact('tRequest'));
        $this->set('_serialize', ['tRequest']);
    }

    /**
     * Edit method
     *
     * @param string|null $id T Request id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tRequest = $this->TRequest->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tRequest = $this->TRequest->patchEntity($tRequest, $this->request->data);
            if ($this->TRequest->save($tRequest)) {
                $this->Flash->success(__('The t request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t request could not be saved. Please, try again.'));
        }
        $this->set(compact('tRequest'));
        $this->set('_serialize', ['tRequest']);
    }

    /**
     * Delete method
     *
     * @param string|null $id T Request id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tRequest = $this->TRequest->get($id);
        if ($this->TRequest->delete($tRequest)) {
            $this->Flash->success(__('The t request has been deleted.'));
        } else {
            $this->Flash->error(__('The t request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function newRequest()
    {
        $tRequest = $this->TRequest->newEntity();
        //if ($this->request->is('post')) {
            //var_dump($this->request->query);
            //$tRequest = $this->TRequest->patchEntity($tRequest, $this->request->query);
            /*$tRequest = $this->TRequest->newEntity();*/
            $newObjeto = [];
            foreach ($this->request->query as $key => $value) {
                # code...
                //$newObjeto[$key] = $value;
                $pos = strpos($key, '_submit');                
                if($pos !== false){
                    $data = explode("_submit",$key);
                    $propiedad = $data[0];
                    $newObjeto[$propiedad] = $value;
                }else{
                    $pos = strpos($key, 'tipoProducto');                
                    if($pos === false){
                        $newObjeto[$key] = $value;
                    }
                }
                
            }        
            $serverDate = date("Y-m-d H:i:s");    
            $newObjeto['ACTIVE'] = 1;
            $newObjeto['LOG'] = '';            
            $newObjeto['DH_REQUEST'] = $serverDate;
            $newObjeto['ID_TP_STATUS_REQ'] = 5;
            $newObjeto['ID_TP_BUSINESS'] = 3;
            if (array_key_exists('DT_FROM', $newObjeto)) {
                $dateF = new Date($newObjeto['DT_FROM']);
                $newObjeto['DT_FROM'] = $dateF->format('Y-m-d H:i:s');
            }
            if (array_key_exists('DT_TO', $newObjeto)) {
                $dateT = new Date($newObjeto['DT_TO']);
                $newObjeto['DT_TO'] = $dateT->format('Y-m-d H:i:s'); 
            }
            if (array_key_exists('DT_TO', $newObjeto)) {
                $dateXF = new Date($newObjeto['DT_PRICE_FIX_FROM']);
                $newObjeto['DT_PRICE_FIX_FROM'] = $dateXF->format('Y-m-d H:i:s');
            }
            if (array_key_exists('DT_TO', $newObjeto)) {
                $dateXT = new Date($newObjeto['DT_PRICE_FIX_TO']);
                $newObjeto['DT_PRICE_FIX_TO'] = $dateXT->format('Y-m-d H:i:s'); 
            }
            // Make the entity think it is new.
            //$tRequest->accessible('*', true);
            $tRequest = $this->TRequest->patchEntity($tRequest, $newObjeto);          
            //$tRequest->clean();            
            //var_dump($tRequest);
            //debug($tRequest);
            if ($this->TRequest->save($tRequest)) {
                /*$tableNotify = TableRegistry::get('TNotifications');
                $tNotification = $tableNotify->newEntity();     
                $tNotification->ID_TYPE_NOTIF = 150;
                $tNotification->ID_USER = $tRequest->ID_USER_OWNER;
                $tNotification->DESCRIPTION = "Nueva Solicitud";
                $tNotification->READ_NOTIF = 0;
                $tNotification->DT_CREATED = $serverDate;
                //debug($tNotification);
                $tableNotify->save($tNotification);*/
                $this->set(compact('tRequest'));
                $this->set('_serialize', ['tRequest']);
                /*debug($tNotification);*/
                                
            }else{
                $tRequest = "no save";
            }
            
            $this->Flash->error(__('The t request could not be saved. Please, try again.'));
            $this->set('tRequest', $tRequest);
            $this->set('_serialize', ['tRequest']);
        //}
    }

    /**
     * Find method
     *
     * @param string|null $id TRequest id.
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
    		$tRequest = $this->TRequest->find('all', array(
                    'order' => ['TRequest.ID_REQUEST' => 'DESC'],
                    'conditions' => array('TRequest.ID_USER_OWNER' => $user,
    					'TRequest.ACTIVE' => 1
    				),
                    'contain' => ['TMarket', 'TProduct', 'TPlace', 'TUser', 'TUm', 'TCurrency', 'TTypes']

            ))
            ->select(['TRequest.ID_REQUEST',
            'TRequest.ID_USER_OWNER',
            'TRequest.DH_REQUEST',
            'TRequest.ID_TP_OPERATION',
            'TRequest.ID_MARKET',
            'TRequest.ID_TP_BUSINESS',
            'TRequest.ID_PRODUCT',
            'TRequest.PRICE_FROM',
            'TRequest.PRICE_TO',
            'TRequest.ID_TP_CURRENCY',
            'TRequest.QT_FROM',
            'TRequest.QT_TO',
            'TRequest.ID_UM',
            'TRequest.DT_FROM',
            'TRequest.DT_TO',
            'TRequest.ID_PLACE_DELIVERY',
            'TRequest.LOC_DISTANCE',
            'TRequest.LOG',
            'TRequest.ID_TP_STATUS_REQ',
            'TRequest.DH_LAST_UPDATE',
            'TRequest.ID_TYPE_PRICE',
            'TRequest.ID_PRICE_REF',
            'TRequest.ID_POSITION',
            'TRequest.DT_PRICE_FIX_FROM',
            'TRequest.DT_PRICE_FIX_TO',
            'TRequest.ID_CROP',
            'TRequest.ID_TYPE_PAYMENT',
            'TRequest.ID_PLACE_ORIGIN',
            'TRequest.ID_TYPE_DELIVERY',
            'TRequest.TYPE_QUALITY',
            'TRequest.QUALITY_INFO',
            'TRequest.ACTIVE',
            'TCurrency.ID_CURRENCY',
            'TCurrency.CURRENCY_NAME',
            'TCurrency.ID_COUNTRY',
            'TUm.ID_UM',
            'TUm.UM_NAME',
            'TUm.ID_COUNTRY',
            'TPlace.ID_PLACE',
            'TPlace.PLACE_NAME',
            'TPlace.ID_COUNTRY',
            'TProduct.ID_PRODUCT',
            'TProduct.PRODUCT_NAME',
            'TProduct.ID_MARKET',
            'TProduct.ID_CATEGORY_PROD',
            'TMarket.ID_MARKET',
            'TMarket.MARKET_NAME',
            'TMarket.ID_COUNTRY',
            'TUser.NAME','TUser.SURNAME',
            'TP_OPERATION' => "(SELECT INFO FROM t_types WHERE t_types.ID_TYPE = TRequest.ID_TP_OPERATION)",
            'STATUS_REQ' => "(SELECT INFO FROM t_types WHERE t_types.ID_TYPE = TRequest.ID_TP_STATUS_REQ)",
            'TYPE_PAYMENT' => "(SELECT INFO FROM t_types WHERE t_types.ID_TYPE = TRequest.ID_TYPE_PAYMENT)"
            ]);
            //debug($tRequest);
    		$count = $tRequest->count();
            if($count > 0){// si existe tRequest  
                //$key = $this->request->session()->read('Auth.TUser.token');
                // return Auth token
                //$this->response->header('token', "Bearer ".$key); 			 
                $this->set(compact('tRequest'));
                $this->set('_serialize', ['tRequest']);                
            }else{
                $data = "no data";
                $this->set('tRequest', $data);
                $this->set('_serialize', ['tRequest']); 
            }     

        }else{
            $data = "null params";
            $this->set('tRequest', $data);
            $this->set('_serialize', ['tRequest']);
        }
    } 

    /**
     * Edit method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function editRequest()
    {
    	$id = null;
    	if(!empty($this->request->query('ID_REQUEST'))){
    		$id = $this->request->query('ID_REQUEST');
    	}else{
    		if(!empty($this->request->query['ID_REQUEST'])){
    			$id = $this->request->query['ID_REQUEST'];
    		}else{
                if(!empty($this->request->data['ID_REQUEST'])){
                    $id = $this->request->data['ID_REQUEST'];
                }else{
                    if(!empty($this->request->data('ID_REQUEST'))){
                        $id = $this->request->data('ID_REQUEST');
                    }
                }
            }
        }

        $tRequest = $this->TRequest->get($id, [
            'contain' => ['TMarket', 'TProduct', 'TPlace', 'TUser', 'TUm', 'TCurrency', 'TTypes']
        ]);
        $tRequest = $this->TRequest->newEntity();
        $newObjeto = [];
        foreach ($this->request->query as $key => $value) {
            # code...
            //$newObjeto[$key] = $value;
            $pos = strpos($key, '_submit');                
            if($pos !== false){
                $data = explode("_submit",$key);
                $propiedad = $data[0];
                $tRequest->$propiedad = $value;
            }else{
                $tRequest->$key = $value;
            }            
            //$tRequest->$key = $value;
        }        
        //$tRequest = $this->TRequest->patchEntity($tRequest, $newObjeto);
        //$tRequest = $this->TRequest->patchEntity($tRequest, $this->request->data);
        
        $dateF = new Time($tRequest->DT_FROM);
        $dateT = new Time($tRequest->DT_TO);
        $tRequest->DT_FROM = $dateF->format('Y-m-d H:i:s');
        $tRequest->DT_TO = $dateT->format('Y-m-d H:i:s');

        $tRequest->DH_LAST_UPDATE = date('Y-m-d H:i:s');  
        $tRequest->DH_REQUEST = date('Y-m-d H:i:s', strtotime($tRequest->DH_REQUEST));        
        //debug($tRequest);
        if ($this->TRequest->save($tRequest)) {
            $tRequest = $this->TRequest->get($id, [
                'contain' => ['TMarket', 'TProduct', 'TPlace', 'TUser', 'TUm', 'TCurrency', 'TTypes']
            ]);            
            $this->set(compact('tRequest'));
            $this->set('_serialize', ['tRequest']);
        }else{
            $tRequest = "no update";
        }
        $this->set('tRequest', $tRequest);
        $this->set('_serialize', ['tRequest']);
    
    }
    

    /**
     * Delete method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function deleteRequest()
    {
        $id = null;
        if(!empty($this->request->query('ID_REQUEST'))){
    		$id = $this->request->query('ID_REQUEST');
    	}else{
    		if(!empty($this->request->query['ID_REQUEST'])){
    			$id = $this->request->query['ID_REQUEST'];
    		}else{
                if(!empty($this->request->data['ID_REQUEST'])){
                    $id = $this->request->data['ID_REQUEST'];
                }else{
                    if(!empty($this->request->data('ID_REQUEST'))){
                        $id = $this->request->data('ID_REQUEST');
                    }
                }
            }
        }

        $tRequest = $this->TRequest->get($id, [
            'contain' => []
        ]);
        $tRequest = $this->TRequest->patchEntity($tRequest, $this->request->data);
        $tRequest->ACTIVE = 0;
        if ($this->TRequest->save($tRequest)) {
            $this->set(compact('tRequest'));
            $this->set('_serialize', ['tRequest']);
        }else{
            $tRequest = "no delete";
        }
        $this->set('tRequest', $tRequest);
        $this->set('_serialize', ['tRequest']);
    
    }    

    /**
     * Filter method
     *
     * @param string|null $id TRequest id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function filter()
    {
    	$user = null;
    	if(!empty($this->request->query('ID_USER_OWNER'))){
    		$user = $this->request->query('ID_USER_OWNER');
    	}else{
    		if(!empty($this->request->query['ID_USER_OWNER'])){
    			$user = $this->request->query['ID_USER_OWNER'];
    		}
        }

        $conditions = array();
        $fromP = 0;
        $toP = 0; 
        $fromC = 0;
        $toC = 0;
        $fromF = 0;
        $toF = 0;                        
        foreach ($this->request->query as $key => $value) {
            # code...
            if(!empty($value)){
                if($key == 'ID_USER_OWNER'){
                    $conditions["TRequest.".strtoupper($key)." != "] = $value;
                }else{
                    if($key != 'tipoProducto'){
                        if($key == 'PRICE_FROM'){
                            $fromP = $value;
                        }else{
                            if($key == 'PRICE_TO'){
                                $toP = $value;
                            }else{
                                if($key == 'QT_FROM'){
                                    $fromC = $value;
                                }else{
                                    if($key == 'QT_TO'){
                                        $toC = $value;
                                    }else{
                                        if($key == 'DT_FROM_submit'){
                                            $fromF = $value;
                                        }else{
                                            if($key == 'DT_TO_submit'){
                                                $toF = $value;
                                            }else{
                                                if($key == 'ID_TP_OPERATION'){
                                                    $conditions["TRequest.".strtoupper($key)." !="] = $value;
                                                }else{
                                                    $pos = strpos($key, '_submit');                
                                                    if($pos !== false){
                                                        $data = explode("_submit",$key);
                                                        $propiedad = $data[0];
                                                        $conditions["TRequest.".strtoupper($propiedad)] = $value;
                                                    }else{
                                                        $conditions["TRequest.".strtoupper($key)] = $value;
                                                    }
                                                    
                                                }
                                            }                                        
                                            
        
                                        }
                                    }
    
                                }
                                
                            }
                        }
                    }                
                }
            }
        }

        if( $fromP != 0 && $toP != 0){
            $conditions["OR"] = array('AND' => array(
                    array('TRequest.PRICE_FROM >=' => $fromP),
                    array('TRequest.PRICE_FROM <=' => $toP)
            ), array('AND' => array(
                    array('TRequest.PRICE_TO >=' => $fromP),
                    array('TRequest.PRICE_TO <=' => $toP)
                ))
            );
        }else{
            if( $fromP != 0 ){
 
                $conditions["OR"] = array('AND' => array(
                    array('TRequest.PRICE_FROM >=' => $fromP),
                    array('TRequest.PRICE_FROM <=' => $fromP)
                ), array('AND' => array(
                        array('TRequest.PRICE_TO >=' => $fromP),
                        array('TRequest.PRICE_TO <=' => $fromP)
                    ))
                );                           
            }else{
                if( $toP != 0 ){
                    $conditions["OR"] = array('AND' => array(
                        array('TRequest.PRICE_FROM >=' => $toP),
                        array('TRequest.PRICE_FROM <=' => $toP)
                    ), array('AND' => array(
                            array('TRequest.PRICE_TO >=' => $toP),
                            array('TRequest.PRICE_TO <=' => $toP)
                        ))
                    );                                   
                }              
            }
        }

        if( $fromC != 0 && $toC != 0){

            $conditions["OR"] = array('AND' => array(
                array('TRequest.QT_FROM >=' => $fromC),
                array('TRequest.QT_FROM <=' => $toC)
            ), array('AND' => array(
                    array('TRequest.QT_TO >=' => $fromC),
                    array('TRequest.QT_TO <=' => $toC)
                ))
            );             
        }else{
            if( $fromC != 0 ){

                $conditions["OR"] = array('AND' => array(
                    array('TRequest.QT_FROM >=' => $fromC),
                    array('TRequest.QT_FROM <=' => $fromC)
                ), array('AND' => array(
                        array('TRequest.QT_TO >=' => $fromC),
                        array('TRequest.QT_TO <=' => $fromC)
                    ))
                );                              
            }else{
                if( $toC != 0 ){
                    $conditions["OR"] = array('AND' => array(
                        array('TRequest.QT_FROM >=' => $toC),
                        array('TRequest.QT_FROM <=' => $toC)
                    ), array('AND' => array(
                            array('TRequest.QT_TO >=' => $toC),
                            array('TRequest.QT_TO <=' => $toC)
                        ))
                    );                
                }              
            }
        }

        if( $fromF != 0 && $toF != 0){
            $conditions["OR"] = array(
                array('TRequest.DT_FROM BETWEEN ? AND ?' => [$fromF,$toF]),
                array('TRequest.DT_TO BETWEEN ? AND ?' => [$fromF,$toF])
            );
        }else{
            if( $fromF != 0 ){
                $conditions["OR"] = array(
                    array('TRequest.DT_FROM BETWEEN ? AND ?' => [$fromF,$fromF]),
                    array('TRequest.DT_TO BETWEEN ? AND ?' => [$fromF,$fromF])
                );              
            }else{
                if( $toF != 0 ){
                    $conditions["OR"] = array(
                        array('TRequest.DT_FROM BETWEEN ? AND ?' => [$toF,$toF]),
                        array('TRequest.DT_TO BETWEEN ? AND ?' => [$toF,$toF])
                    );                
                }              
            }
        }

        if($user){
    		$tRequest = $this->TRequest->find('all', array(
                    'order' => ['TRequest.ID_REQUEST' => 'DESC'],
                    'conditions' => $conditions,
                    'contain' => ['TMarket', 'TProduct', 'TPlace', 'TUser', 'TUm', 'TCurrency', 'TTypes']

            ))
            ->select(['TRequest.ID_REQUEST',
            'TRequest.ID_USER_OWNER',
            'TRequest.DH_REQUEST',
            'TRequest.ID_TP_OPERATION',
            'TRequest.ID_MARKET',
            'TRequest.ID_TP_BUSINESS',
            'TRequest.ID_PRODUCT',
            'TRequest.PRICE_FROM',
            'TRequest.PRICE_TO',
            'TRequest.ID_TP_CURRENCY',
            'TRequest.QT_FROM',
            'TRequest.QT_TO',
            'TRequest.ID_UM',
            'TRequest.DT_FROM',
            'TRequest.DT_TO',
            'TRequest.ID_PLACE_DELIVERY',
            'TRequest.LOC_DISTANCE',
            'TRequest.LOG',
            'TRequest.ID_TP_STATUS_REQ',
            'TRequest.DH_LAST_UPDATE',
            'TRequest.ID_TYPE_PRICE',
            'TRequest.ID_PRICE_REF',
            'TRequest.ID_POSITION',
            'TRequest.DT_PRICE_FIX_FROM',
            'TRequest.DT_PRICE_FIX_TO',
            'TRequest.ID_CROP',
            'TRequest.ID_TYPE_PAYMENT',
            'TRequest.ID_PLACE_ORIGIN',
            'TRequest.ID_TYPE_DELIVERY',
            'TRequest.TYPE_QUALITY',
            'TRequest.QUALITY_INFO',
            'TRequest.ACTIVE',
            'TCurrency.ID_CURRENCY',
            'TCurrency.CURRENCY_NAME',
            'TCurrency.ID_COUNTRY',
            'TUm.ID_UM',
            'TUm.UM_NAME',
            'TUm.ID_COUNTRY',
            'TPlace.ID_PLACE',
            'TPlace.PLACE_NAME',
            'TPlace.ID_COUNTRY',
            'TProduct.ID_PRODUCT',
            'TProduct.PRODUCT_NAME',
            'TProduct.ID_MARKET',
            'TProduct.ID_CATEGORY_PROD',
            'TMarket.ID_MARKET',
            'TMarket.MARKET_NAME',
            'TMarket.ID_COUNTRY',
            'TUser.NAME','TUser.SURNAME',
            'TP_OPERATION' => "(SELECT INFO FROM t_types WHERE t_types.ID_TYPE = TRequest.ID_TP_OPERATION)",
            'STATUS_REQ' => "(SELECT INFO FROM t_types WHERE t_types.ID_TYPE = TRequest.ID_TP_STATUS_REQ)",
            'TYPE_PAYMENT' => "(SELECT INFO FROM t_types WHERE t_types.ID_TYPE = TRequest.ID_TYPE_PAYMENT)"
            ]);            
            //debug($tRequest);
    		$count = $tRequest->count();
    		if($count > 0){// si existe tRequest     			 
                $this->set(compact('tRequest'));
                $this->set('_serialize', ['tRequest']);                
            }else{
                $data = "Filtros, no arrojaron resultados";
                $this->set('tRequest', $data);
                $this->set('_serialize', ['tRequest']); 
            }

        }else{
            $data = "null params";
            $this->set('tRequest', $data);
            $this->set('_serialize', ['tRequest']);
        }
    }        


    /**
     * Filter method
     *
     * @param string|null $id TRequest id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function filterPage()
    {
    	$page = 1;
    	if(!empty($this->request->query('page'))){
    		$page = $this->request->query('page');
    	}else{
    		if(!empty($this->request->query['page'])){
    			$page = $this->request->query['page'];
    		}
        }

    	$user = null;
    	if(!empty($this->request->query('ID_USER_OWNER'))){
    		$user = $this->request->query('ID_USER_OWNER');
    	}else{
    		if(!empty($this->request->query['ID_USER_OWNER'])){
    			$user = $this->request->query['ID_USER_OWNER'];
    		}
        }

        $conditions = array();
        $fromP = 0;
        $toP = 0; 
        $fromC = 0;
        $toC = 0;
        $fromF = 0;
        $toF = 0;                        
        foreach ($this->request->query as $key => $value) {
            # code...
            if(!empty($value)){
                if($key == 'ID_USER_OWNER'){
                    $conditions["TRequest.".strtoupper($key)." != "] = $value;
                }else{
                    if($key != 'tipoProducto'){
                        if($key == 'PRICE_FROM'){
                            $fromP = $value;
                        }else{
                            if($key == 'PRICE_TO'){
                                $toP = $value;
                            }else{
                                if($key == 'QT_FROM'){
                                    $fromC = $value;
                                }else{
                                    if($key == 'QT_TO'){
                                        $toC = $value;
                                    }else{
                                        if($key == 'DT_FROM_submit'){
                                            $fromF = $value;
                                        }else{
                                            if($key == 'DT_TO_submit'){
                                                $toF = $value;
                                            }else{
                                                if($key == 'ID_TP_OPERATION'){
                                                    $conditions["TRequest.".strtoupper($key)." !="] = $value;
                                                }else{
                                                    $pos = strpos($key, '_submit');                
                                                    if($pos !== false){
                                                        $data = explode("_submit",$key);
                                                        $propiedad = $data[0];
                                                        $conditions["TRequest.".strtoupper($propiedad)] = $value;
                                                    }else{
                                                        $conditions["TRequest.".strtoupper($key)] = $value;
                                                    }
                                                    
                                                }
                                            }                                        
                                            
        
                                        }
                                    }
    
                                }
                                
                            }
                        }
                    }                
                }
            }
        }

        if( $fromP != 0 && $toP != 0){
            $conditions["OR"] = array('AND' => array(
                    array('TRequest.PRICE_FROM >=' => $fromP),
                    array('TRequest.PRICE_FROM <=' => $toP)
            ), array('AND' => array(
                    array('TRequest.PRICE_TO >=' => $fromP),
                    array('TRequest.PRICE_TO <=' => $toP)
                ))
            );
        }else{
            if( $fromP != 0 ){
 
                $conditions["OR"] = array('AND' => array(
                    array('TRequest.PRICE_FROM >=' => $fromP),
                    array('TRequest.PRICE_FROM <=' => $fromP)
                ), array('AND' => array(
                        array('TRequest.PRICE_TO >=' => $fromP),
                        array('TRequest.PRICE_TO <=' => $fromP)
                    ))
                );                           
            }else{
                if( $toP != 0 ){
                    $conditions["OR"] = array('AND' => array(
                        array('TRequest.PRICE_FROM >=' => $toP),
                        array('TRequest.PRICE_FROM <=' => $toP)
                    ), array('AND' => array(
                            array('TRequest.PRICE_TO >=' => $toP),
                            array('TRequest.PRICE_TO <=' => $toP)
                        ))
                    );                                   
                }              
            }
        }

        if( $fromC != 0 && $toC != 0){

            $conditions["OR"] = array('AND' => array(
                array('TRequest.QT_FROM >=' => $fromC),
                array('TRequest.QT_FROM <=' => $toC)
            ), array('AND' => array(
                    array('TRequest.QT_TO >=' => $fromC),
                    array('TRequest.QT_TO <=' => $toC)
                ))
            );             
        }else{
            if( $fromC != 0 ){

                $conditions["OR"] = array('AND' => array(
                    array('TRequest.QT_FROM >=' => $fromC),
                    array('TRequest.QT_FROM <=' => $fromC)
                ), array('AND' => array(
                        array('TRequest.QT_TO >=' => $fromC),
                        array('TRequest.QT_TO <=' => $fromC)
                    ))
                );                              
            }else{
                if( $toC != 0 ){
                    $conditions["OR"] = array('AND' => array(
                        array('TRequest.QT_FROM >=' => $toC),
                        array('TRequest.QT_FROM <=' => $toC)
                    ), array('AND' => array(
                            array('TRequest.QT_TO >=' => $toC),
                            array('TRequest.QT_TO <=' => $toC)
                        ))
                    );                
                }              
            }
        }

        if( $fromF != 0 && $toF != 0){
            $conditions["OR"] = array(
                array('TRequest.DT_FROM BETWEEN ? AND ?' => [$fromF,$toF]),
                array('TRequest.DT_TO BETWEEN ? AND ?' => [$fromF,$toF])
            );
        }else{
            if( $fromF != 0 ){
                $conditions["OR"] = array(
                    array('TRequest.DT_FROM BETWEEN ? AND ?' => [$fromF,$fromF]),
                    array('TRequest.DT_TO BETWEEN ? AND ?' => [$fromF,$fromF])
                );              
            }else{
                if( $toF != 0 ){
                    $conditions["OR"] = array(
                        array('TRequest.DT_FROM BETWEEN ? AND ?' => [$toF,$toF]),
                        array('TRequest.DT_TO BETWEEN ? AND ?' => [$toF,$toF])
                    );                
                }              
            }
        }

        if($user){
    		$tRequest = $this->TRequest->find('all', array(
                    'order' => ['TRequest.ID_REQUEST' => 'DESC'],
                    'conditions' => $conditions,
                    'contain' => ['TMarket', 'TProduct', 'TPlace', 'TUser', 'TUm', 'TCurrency', 'TTypes']

            ))
            ->select(['TRequest.ID_REQUEST',
            'TRequest.ID_USER_OWNER',
            'TRequest.DH_REQUEST',
            'TRequest.ID_TP_OPERATION',
            'TRequest.ID_MARKET',
            'TRequest.ID_TP_BUSINESS',
            'TRequest.ID_PRODUCT',
            'TRequest.PRICE_FROM',
            'TRequest.PRICE_TO',
            'TRequest.ID_TP_CURRENCY',
            'TRequest.QT_FROM',
            'TRequest.QT_TO',
            'TRequest.ID_UM',
            'TRequest.DT_FROM',
            'TRequest.DT_TO',
            'TRequest.ID_PLACE_DELIVERY',
            'TRequest.LOC_DISTANCE',
            'TRequest.LOG',
            'TRequest.ID_TP_STATUS_REQ',
            'TRequest.DH_LAST_UPDATE',
            'TRequest.ID_TYPE_PRICE',
            'TRequest.ID_PRICE_REF',
            'TRequest.ID_POSITION',
            'TRequest.DT_PRICE_FIX_FROM',
            'TRequest.DT_PRICE_FIX_TO',
            'TRequest.ID_CROP',
            'TRequest.ID_TYPE_PAYMENT',
            'TRequest.ID_PLACE_ORIGIN',
            'TRequest.ID_TYPE_DELIVERY',
            'TRequest.TYPE_QUALITY',
            'TRequest.QUALITY_INFO',
            'TRequest.ACTIVE',
            'TCurrency.ID_CURRENCY',
            'TCurrency.CURRENCY_NAME',
            'TCurrency.ID_COUNTRY',
            'TUm.ID_UM',
            'TUm.UM_NAME',
            'TUm.ID_COUNTRY',
            'TPlace.ID_PLACE',
            'TPlace.PLACE_NAME',
            'TPlace.ID_COUNTRY',
            'TProduct.ID_PRODUCT',
            'TProduct.PRODUCT_NAME',
            'TProduct.ID_MARKET',
            'TProduct.ID_CATEGORY_PROD',
            'TMarket.ID_MARKET',
            'TMarket.MARKET_NAME',
            'TMarket.ID_COUNTRY',
            'TUser.NAME','TUser.SURNAME',
            'TP_OPERATION' => "(SELECT INFO FROM t_types WHERE t_types.ID_TYPE = TRequest.ID_TP_OPERATION)",
            'STATUS_REQ' => "(SELECT INFO FROM t_types WHERE t_types.ID_TYPE = TRequest.ID_TP_STATUS_REQ)",
            'TYPE_PAYMENT' => "(SELECT INFO FROM t_types WHERE t_types.ID_TYPE = TRequest.ID_TYPE_PAYMENT)"
            ])            
            ->limit(10)
            ->page($page);            
            //debug($tRequest);
    		$count = $tRequest->count();
            if($count > 0){// si existe tRequest    
                $query = $this->TRequest->find('all', array(
                    'order' => ['TRequest.ID_REQUEST' => 'DESC'],
                    'conditions' => $conditions,
                    'contain' => ['TMarket', 'TProduct', 'TPlace', 'TUser', 'TUm', 'TCurrency', 'TTypes']  
                ));
                $count = $query->count();
                $resp = array();
                $resp["rows"] = $count;
                $resp["data"] = $tRequest;        
                $this->set('tRequest', $resp);                 			 
                $this->set('_serialize', ['tRequest']);                
            }else{
                $data = "Filtros, no arrojaron resultados";
                $this->set('tRequest', $data);
                $this->set('_serialize', ['tRequest']); 
            }

        }else{
            $data = "null params";
            $this->set('tRequest', $data);
            $this->set('_serialize', ['tRequest']);
        }
    }        

    /**
     * Page method
     *
     * @return \Cake\Network\Response|null
     */
    public function page()
    {
    	$page = 1;
    	if(!empty($this->request->query('page'))){
    		$page = $this->request->query('page');
    	}else{
    		if(!empty($this->request->query['page'])){
    			$page = $this->request->query['page'];
    		}
        }

    	$user = null;
    	if(!empty($this->request->query('user'))){
    		$user = $this->request->query('user');
    	}else{
    		if(!empty($this->request->query['user'])){
    			$user = $this->request->query['user'];
    		}
        }
        if($user){
            $tRequest = $this->TRequest->find('all', array(
                'order' => ['TTypes.ORDER_INFO' => 'ASC',
                "TRequest.ID_TP_OPERATION" => 'ASC',
                "TRequest.ID_PRODUCT" => 'ASC',
                "TRequest.DH_REQUEST" => 'ASC'
                ],
                'conditions' => array('TRequest.ID_USER_OWNER' => $user,
                    'TRequest.ACTIVE' => 1
                ),
                'contain' => ['TMarket', 'TProduct', 'TPlace', 'TUser', 'TUm', 'TCurrency', 'TTypes']

            ))
            ->select(['TRequest.ID_REQUEST',
            'TRequest.ID_USER_OWNER',
            'TRequest.DH_REQUEST',
            'TRequest.ID_TP_OPERATION',
            'TRequest.ID_MARKET',
            'TRequest.ID_TP_BUSINESS',
            'TRequest.ID_PRODUCT',
            'TRequest.PRICE_FROM',
            'TRequest.PRICE_TO',
            'TRequest.ID_TP_CURRENCY',
            'TRequest.QT_FROM',
            'TRequest.QT_TO',
            'TRequest.ID_UM',
            'TRequest.DT_FROM',
            'TRequest.DT_TO',
            'TRequest.ID_PLACE_DELIVERY',
            'TRequest.LOC_DISTANCE',
            'TRequest.LOG',
            'TRequest.ID_TP_STATUS_REQ',
            'TRequest.DH_LAST_UPDATE',
            'TRequest.ID_TYPE_PRICE',
            'TRequest.ID_PRICE_REF',
            'TRequest.ID_POSITION',
            'TRequest.DT_PRICE_FIX_FROM',
            'TRequest.DT_PRICE_FIX_TO',
            'TRequest.ID_CROP',
            'TRequest.ID_TYPE_PAYMENT',
            'TRequest.ID_PLACE_ORIGIN',
            'TRequest.ID_TYPE_DELIVERY',
            'TRequest.TYPE_QUALITY',
            'TRequest.QUALITY_INFO',
            'TRequest.ACTIVE',
            'TCurrency.ID_CURRENCY',
            'TCurrency.CURRENCY_NAME',
            'TCurrency.ID_COUNTRY',
            'TUm.ID_UM',
            'TUm.UM_NAME',
            'TUm.ID_COUNTRY',
            'TPlace.ID_PLACE',
            'TPlace.PLACE_NAME',
            'TPlace.ID_COUNTRY',
            'TProduct.ID_PRODUCT',
            'TProduct.PRODUCT_NAME',
            'TProduct.ID_MARKET',
            'TProduct.ID_CATEGORY_PROD',
            'TMarket.ID_MARKET',
            'TMarket.MARKET_NAME',
            'TMarket.ID_COUNTRY',
            'TUser.NAME','TUser.SURNAME',
            'TP_OPERATION' => "(SELECT INFO FROM t_types WHERE t_types.ID_TYPE = TRequest.ID_TP_OPERATION)",
            'STATUS_REQ' => "(SELECT INFO FROM t_types WHERE t_types.ID_TYPE = TRequest.ID_TP_STATUS_REQ)",
            'TYPE_PAYMENT' => "(SELECT INFO FROM t_types WHERE t_types.ID_TYPE = TRequest.ID_TYPE_PAYMENT)"
            ])            
            ->limit(10)
            ->page($page);
    		$countR = $tRequest->count();
            if($countR > 0){// si existe tRequest 
                $query = $this->TRequest->find('all', array(
                    'conditions' => array('TRequest.ID_USER_OWNER' => $user,
                        'TRequest.ACTIVE' => 1
                    ),
                    'contain' => []    
                ));
                $count = $query->count();
                $resp = array();
                $resp["rows"] = $count;
                $resp["data"] = $tRequest;        
                $this->set('tRequest', $resp);
                $this->set('_serialize', ['tRequest']);
            }else{
                $data = "no data";
                $this->set('tRequest', $data);
                $this->set('_serialize', ['tRequest']); 
            }  

        }else{
            $data = "null params";
            $this->set('tRequest', $data);
            $this->set('_serialize', ['tRequest']);
        }            
    }  
    
    /**
     * resumen method
     *
     * @return \Cake\Network\Response|null
     */
    public function resumen()
    {
    	$user = null;
        if(!empty($this->request->query('user'))){
    		$user = $this->request->query('user');
    	}else{
    		if(!empty($this->request->query['user'])){
    			$user = $this->request->query['user'];
    		}else{
                if(!empty($this->request->data['user'])){
                    $user = $this->request->data['user'];
                }else{
                    if(!empty($this->request->data('user'))){
                        $user = $this->request->data('user');
                    }
                }
            }
        }
        if($user){
            $tRequest = $this->TRequest->find('all', array(
                'order' => [],
                'conditions' => array('TRequest.ID_USER_OWNER' => $user,
                    'TRequest.ACTIVE' => 1
                ),
                'contain' => []

            ))
            ->select(['usr.ID_USER', 'typ.INFO', 'prd.PRODUCT_NAME',  
            'QT_AVG_TOT' => 'ROUND(SUM(((TRequest.QT_FROM + TRequest.QT_TO)/2)),0)',
            'PRICE_AVG_TOT' => 'ROUND(AVG(((TRequest.PRICE_FROM + TRequest.PRICE_TO)/2)),0)',
            'cant' => 'COUNT(*)'
            ])
            ->join([
                'usr' => [
                    'table' => 't_user',
                    'type' => 'LEFT',
                    'conditions' => [
                        'TRequest.ID_USER_OWNER = usr.ID_USER'                           
                    ]
                ],                
                'prd' => [
                    'table' => 't_product',
                    'type' => 'LEFT',
                    'conditions' => [
                        'TRequest.ID_PRODUCT = prd.ID_PRODUCT'                           
                    ]
                ],                
                'typ' => [
                    'table' => 't_types',
                    'type' => 'LEFT',
                    'conditions' => [
                        'TRequest.ID_TP_OPERATION = typ.ID_TYPE'                           
                    ]
                ]      
                    
                    ]
            )
            ->group(['usr.ID_USER', 'typ.INFO', 'prd.PRODUCT_NAME']); 
            //debug($tRequest);           
    		$countR = $tRequest->count();
            if($countR > 0){// si existe tRequest        
                $this->set('tRequest', $tRequest);
                $this->set('_serialize', ['tRequest']);
            }else{
                $data = "no data";
                $this->set('tRequest', $data);
                $this->set('_serialize', ['tRequest']); 
            }  

        }else{
            $data = "null params";
            $this->set('tRequest', $data);
            $this->set('_serialize', ['tRequest']);
        }            
    }    
    

}

    