<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Model\Entity\TTrade;
/**
 * TTrade Controller
 *
 * @property \App\Model\Table\TTradeTable $TTrade
 */
class TTradeController extends AppController
{
	
	public function initialize()
	{
		parent::initialize();
		if($this->request->session()->check('Auth.TUser.token')){
            $this->Auth->allow(['newTrade','find','confirmTrade','deleteTrade']);
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
        $tTrade = $this->paginate($this->TTrade);

        $this->set(compact('tTrade'));
        $this->set('_serialize', ['tTrade']);
    }

    /**
     * View method
     *
     * @param string|null $id T Trade id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tTrade = $this->TTrade->get($id, [
            'contain' => []
        ]);

        $this->set('tTrade', $tTrade);
        $this->set('_serialize', ['tTrade']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tTrade = $this->TTrade->newEntity();
        if ($this->request->is('post')) {
            $tTrade = $this->TTrade->patchEntity($tTrade, $this->request->data);
            if ($this->TTrade->save($tTrade)) {
                $this->Flash->success(__('The t trade has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t trade could not be saved. Please, try again.'));
        }
        $this->set(compact('tTrade'));
        $this->set('_serialize', ['tTrade']);
    }

    /**
     * Edit method
     *
     * @param string|null $id T Trade id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tTrade = $this->TTrade->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tTrade = $this->TTrade->patchEntity($tTrade, $this->request->data);
            if ($this->TTrade->save($tTrade)) {
                $this->Flash->success(__('The t trade has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t trade could not be saved. Please, try again.'));
        }
        $this->set(compact('tTrade'));
        $this->set('_serialize', ['tTrade']);
    }

    /**
     * Delete method
     *
     * @param string|null $id T Trade id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tTrade = $this->TTrade->get($id);
        if ($this->TTrade->delete($tTrade)) {
            $this->Flash->success(__('The t trade has been deleted.'));
        } else {
            $this->Flash->error(__('The t trade could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function newTrade()
    {
        $tTrade = $this->TTrade->newEntity();
        //if ($this->request->is('post')) {
            //var_dump($this->request->query);
            $newObjeto = [];
            foreach ($this->request->query as $key => $value) {
                # code...
                $newObjeto[$key] = $value;
            }    
            $serverDate = date('Y-m-d H:i:s');       
            $newObjeto['ID_TP_STATUS_TRADE'] = 100;
            $newObjeto['CONFIRMED_OWNER'] = 1;
            $newObjeto['CONFIRMED_CPART'] = 0;
            $newObjeto['DH_CREATION'] = $serverDate;
            $tTrade = $this->TTrade->patchEntity($tTrade, $newObjeto);
            //debug($tTrade);
            if ($this->TTrade->save($tTrade)) {
                $tableNotify = TableRegistry::get('TNotifications');
                $tNotification = $tableNotify->newEntity();     
                $tNotification->ID_TYPE_NOTIF = 150;
                $tNotification->ID_USER = $tTrade->ID_USER_OWNER;
                $tNotification->DESCRIPTION = "Nuevo Negocio";
                $tNotification->READ_NOTIF = 0;
                $tNotification->DT_CREATED = $serverDate;  
                $tableNotify->save($tNotification);              
                $this->set('tTrade', "newTrade");
                $this->set('_serialize', ['tTrade']);
            }else{
                $tTrade = "no save";
            }           
            $this->Flash->error(__('The t request could not be saved. Please, try again.'));
            $this->set('tTrade', $tTrade);
            $this->set('_serialize', ['tTrade']);
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

    		$tTrade = $this->TTrade->find('all', array(
                    'order' => ['TTrade.ID_TRADE' => 'DESC'],
                    'contain' => ['TRequest', 'TUserOwer','TUserCpart', 'TUm', 'TCurrency', 'TTypes']
            ))
            ->orWhere(function ($exp) use ($user) {
                return $exp
                    ->and_(['TTrade.ID_USER_OWNER' => $user])
                    ->eq('TTrade.ID_TP_STATUS_TRADE ', 100);
            })            
            ->orWhere(function ($exp) use ($user) {
                return $exp
                    ->and_(['TTrade.ID_USER_OWNER' => $user])
                    ->gt('TTrade.ID_TP_STATUS_TRADE ', 100);
            })
            ->orWhere(function ($exp) use ($user) {
                return $exp
                    ->and_(['TTrade.ID_USER_CPART' => $user])
                    ->gt('TTrade.ID_TP_STATUS_TRADE ', 100);
            })

            ->select(['TTrade.ID_TRADE','TTrade.ID_REQUEST',
            'TTrade.ID_USER_OWNER', 'TTrade.ID_USER_CPART', 'TTrade.PRICE', 'TTrade.ID_TP_CURRENCY',
            'TTrade.QT', 'TTrade.ID_UM', 'TTrade.CONFIRMED_OWNER', 'TTrade.CONFIRMED_CPART',
            'TTrade.DH_CREATION', 'TTrade.ID_TP_STATUS_TRADE',
            'TRequest.DT_FROM','TRequest.DT_TO','BUSINESS' => '(SELECT INFO FROM t_types
            WHERE t_types.ID_TYPE = TRequest.ID_TP_BUSINESS)','OPERATION' => '(SELECT INFO FROM t_types
            WHERE t_types.ID_TYPE = TRequest.ID_TP_OPERATION)',
            'INFO1' => '(SELECT INFO1 FROM t_types
            WHERE t_types.ID_TYPE = TTrade.ID_TP_STATUS_TRADE)',
            'MARKET_NAME' => '(SELECT MARKET_NAME FROM t_market
            WHERE t_market.ID_MARKET = TRequest.ID_MARKET)','TRequest.LOC_DISTANCE',            
            'TUserOwer.MAIL','TUserOwer.NAME', 'TUserOwer.SURNAME','TUserOwer.PHONE_MOBILE_COUNTRY','TUserOwer.PHONE_MOBILE_NUM',
            'TUserOwer.PHONE_OTHER_COUNTRY','TUserOwer.PHONE_OTHER_NUM',
            'TUserCpart.MAIL','TUserCpart.NAME','TUserCpart.SURNAME','TUserCpart.PHONE_MOBILE_COUNTRY','TUserCpart.PHONE_MOBILE_NUM',
            'TUserCpart.PHONE_OTHER_COUNTRY','TUserCpart.PHONE_OTHER_NUM',
            'PLACE_CPART' => '(SELECT PLACE_NAME FROM t_place
            WHERE t_place.ID_PLACE = TUserCpart.ID_PLACE)',            
            'TUm.UM_NAME','TCurrency.CURRENCY_NAME','TTypes.INFO', 't_product.PRODUCT_NAME'
            ])           
            ->join([
                'TRequest' => [
                    'table' => 't_request',
                    'type' => 'LEFT',
                    'conditions' => [
                        'TRequest.ID_REQUEST = TTrade.ID_REQUEST'                           
                    ]
                ],                
                't_product' => [
                    'table' => 't_product',
                    'type' => 'LEFT',
                    'conditions' => [
                        'TRequest.ID_PRODUCT = t_product.ID_PRODUCT'                           
                    ]
                ],                
                't_market' => [
                    'table' => 't_market',
                    'type' => 'LEFT',
                    'conditions' => [
                        'TRequest.ID_MARKET = t_market.ID_MARKET'                           
                    ]
                ]      
                    
                    ]
            );
            //debug($tTrade);
    		$count = $tTrade->count();
    		if($count > 0){// si existe tTrade    			 
                $this->set(compact('tTrade'));
                $this->set('_serialize', ['tTrade']);                
            }else{
                $data = "no data";
                $this->set('tTrade', $data);
                $this->set('_serialize', ['tTrade']); 
            }     

        }else{
            $data = "null params";
            $this->set('tTrade', $data);
            $this->set('_serialize', ['tTrade']);
        }
    }  
    

    /**
     * Edit method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function confirmTrade()
    {
    	$id = null;
    	if(!empty($this->request->query('ID_TRADE'))){
    		$id = $this->request->query('ID_TRADE');
    	}else{
    		if(!empty($this->request->query['ID_TRADE'])){
    			$id = $this->request->query['ID_TRADE'];
    		}else{
                if(!empty($this->request->data['ID_TRADE'])){
                    $id = $this->request->data['ID_TRADE'];
                }else{
                    if(!empty($this->request->data('ID_TRADE'))){
                        $id = $this->request->data('ID_TRADE');
                    }
                }
            }
        }

        $tTrade = $this->TTrade->get($id, [
            'contain' => []
        ]);
        $tTrade = $this->TTrade->patchEntity($tTrade, $this->request->query);
        $tTrade->DH_CREATION = date('Y-m-d H:i:s', strtotime($tTrade->DH_CREATION));
              
        //debug($tTrade);
        if ($this->TTrade->save($tTrade)) {
            $descrip = "";
            if($tTrade->ID_TP_STATUS_TRADE == 101){
                $descrip = "Negocio Iniciado";
            }else{
                if($tTrade->ID_TP_STATUS_TRADE == 102){
                    $descrip = "Negocio Confirmado x la otra parte";
                }else{
                    if($tTrade->ID_TP_STATUS_TRADE == 103){
                        $descrip = "Negocio Confirmado x ambas partes";
                    }else{
                        if($tTrade->ID_TP_STATUS_TRADE == 104){
                            $descrip = "Negocio Terminado";
                        }else{
                            if($tTrade->ID_TP_STATUS_TRADE == 105){
                                $descrip = "Negocio Cancelado";
                            }else{
                                
                            }
                        }
                    }
                }
            }
            $tableNotify = TableRegistry::get('TNotifications');
            $tNotification = $tableNotify->newEntity();     
            $tNotification->ID_TYPE_NOTIF = 150;
            $tNotification->ID_USER = $tTrade->ID_USER_OWNER;
            $tNotification->DESCRIPTION = $descrip;
            $tNotification->READ_NOTIF = 0;
            $tNotification->DT_CREATED = $serverDate;
            //debug($tNotification);
            $tableNotify->save($tNotification);

    		$tTrade = $this->TTrade->find('all', array(
                    'order' => ['TTrade.ID_TRADE' => 'DESC'],
                    'conditions' => array('TTrade.ID_TRADE' => $id
                    ),
                    'contain' => ['TRequest', 'TUserOwer','TUserCpart', 'TUm', 'TCurrency', 'TTypes']
            ))
            ->select(['TTrade.ID_TRADE','TTrade.ID_REQUEST',
            'TTrade.ID_USER_OWNER', 'TTrade.ID_USER_CPART', 'TTrade.PRICE', 'TTrade.ID_TP_CURRENCY',
            'TTrade.QT', 'TTrade.ID_UM', 'TTrade.CONFIRMED_OWNER', 'TTrade.CONFIRMED_CPART',
            'TTrade.DH_CREATION', 'TTrade.ID_TP_STATUS_TRADE',
            'TRequest.DT_FROM','TRequest.DT_TO','BUSINESS' => '(SELECT INFO FROM t_types
            WHERE t_types.ID_TYPE = TRequest.ID_TP_BUSINESS)','OPERATION' => '(SELECT INFO FROM t_types
            WHERE t_types.ID_TYPE = TRequest.ID_TP_OPERATION)',
            'INFO1' => '(SELECT INFO1 FROM t_types
            WHERE t_types.ID_TYPE = TTrade.ID_TP_STATUS_TRADE)',
            'MARKET_NAME' => '(SELECT MARKET_NAME FROM t_market
            WHERE t_market.ID_MARKET = TRequest.ID_MARKET)','TRequest.LOC_DISTANCE',          
            'TUserOwer.MAIL','TUserOwer.NAME', 'TUserOwer.SURNAME','TUserOwer.PHONE_MOBILE_COUNTRY','TUserOwer.PHONE_MOBILE_NUM',
            'TUserOwer.PHONE_OTHER_COUNTRY','TUserOwer.PHONE_OTHER_NUM',
            'TUserCpart.MAIL','TUserCpart.NAME','TUserCpart.SURNAME','TUserCpart.PHONE_MOBILE_COUNTRY','TUserCpart.PHONE_MOBILE_NUM',
            'TUserCpart.PHONE_OTHER_COUNTRY','TUserCpart.PHONE_OTHER_NUM',
            'PLACE_CPART' => '(SELECT PLACE_NAME FROM t_place
            WHERE t_place.ID_PLACE = TUserCpart.ID_PLACE)',             
            'TUm.UM_NAME','TCurrency.CURRENCY_NAME','TTypes.INFO', 't_product.PRODUCT_NAME'
            ])            
            ->join([
                'TRequest' => [
                    'table' => 't_request',
                    'type' => 'LEFT',
                    'conditions' => [
                        'TRequest.ID_REQUEST = TTrade.ID_REQUEST'                           
                    ]
                ],                
                't_product' => [
                    'table' => 't_product',
                    'type' => 'LEFT',
                    'conditions' => [
                        'TRequest.ID_PRODUCT = t_product.ID_PRODUCT'                           
                    ]
                ],                
                't_market' => [
                    'table' => 't_market',
                    'type' => 'LEFT',
                    'conditions' => [
                        'TRequest.ID_MARKET = t_market.ID_MARKET'                           
                    ]
                ]      
                    
                    ]
            );            
            $this->set(compact('tTrade'));
            $this->set('_serialize', ['tTrade']);
        }else{
            $tTrade = "no update";
        }
        $this->set('tTrade', $tTrade);
        $this->set('_serialize', ['tTrade']);
    
    }   

    /**
     * Delete trade
     *
     * @param string|null $id T Trade id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteTrade()
    {
    	$id = null;
    	if(!empty($this->request->query('ID_TRADE'))){
    		$id = $this->request->query('ID_TRADE');
    	}else{
    		if(!empty($this->request->query['ID_TRADE'])){
    			$id = $this->request->query['ID_TRADE'];
    		}else{
                if(!empty($this->request->data['ID_TRADE'])){
                    $id = $this->request->data['ID_TRADE'];
                }else{
                    if(!empty($this->request->data('ID_TRADE'))){
                        $id = $this->request->data('ID_TRADE');
                    }
                }
            }
        }   
        
    	$user = null;
    	if(!empty($this->request->query('USER'))){
    		$user = $this->request->query('USER');
    	}else{
    		if(!empty($this->request->query['USER'])){
    			$user = $this->request->query['USER'];
    		}else{
                if(!empty($this->request->data['USER'])){
                    $user = $this->request->data['USER'];
                }else{
                    if(!empty($this->request->data('USER'))){
                        $user = $this->request->data('USER');
                    }
                }
            }
        }         
        //$this->request->allowMethod(['post', 'delete']);
        $tTrade = $this->TTrade->get($id);
        if ($this->TTrade->delete($tTrade)) {
            if($user){
                $tTrade = $this->TTrade->find('all', array(
                        'order' => ['TTrade.ID_TRADE' => 'DESC'],
                        'conditions' => array(
                            'OR' => array('TTrade.ID_USER_OWNER' => $user,'TTrade.ID_USER_CPART' => $user)
                        ),
                        'contain' => ['TRequest', 'TUserOwer','TUserCpart', 'TUm', 'TCurrency', 'TTypes']
                ))
                ->select(['TTrade.ID_TRADE','TTrade.ID_REQUEST',
                'TTrade.ID_USER_OWNER', 'TTrade.ID_USER_CPART', 'TTrade.PRICE', 'TTrade.ID_TP_CURRENCY',
                'TTrade.QT', 'TTrade.ID_UM', 'TTrade.CONFIRMED_OWNER', 'TTrade.CONFIRMED_CPART',
                'TTrade.DH_CREATION', 'TTrade.ID_TP_STATUS_TRADE',
                'TRequest.DT_FROM','TRequest.DT_TO','BUSINESS' => '(SELECT INFO FROM t_types
                WHERE t_types.ID_TYPE = TRequest.ID_TP_BUSINESS)','OPERATION' => '(SELECT INFO FROM t_types
                WHERE t_types.ID_TYPE = TRequest.ID_TP_OPERATION)',
                'INFO1' => '(SELECT INFO1 FROM t_types
                WHERE t_types.ID_TYPE = TTrade.ID_TP_STATUS_TRADE)',
                'MARKET_NAME' => '(SELECT MARKET_NAME FROM t_market
                WHERE t_market.ID_MARKET = TRequest.ID_MARKET)', 'TRequest.LOC_DISTANCE',           
                'TUserOwer.MAIL','TUserOwer.NAME', 'TUserOwer.SURNAME','TUserOwer.PHONE_MOBILE_COUNTRY','TUserOwer.PHONE_MOBILE_NUM',
                'TUserOwer.PHONE_OTHER_COUNTRY','TUserOwer.PHONE_OTHER_NUM',
                'TUserCpart.MAIL','TUserCpart.NAME','TUserCpart.SURNAME','TUserCpart.PHONE_MOBILE_COUNTRY','TUserCpart.PHONE_MOBILE_NUM',
                'TUserCpart.PHONE_OTHER_COUNTRY','TUserCpart.PHONE_OTHER_NUM',
                'PLACE_CPART' => '(SELECT PLACE_NAME FROM t_place
                WHERE t_place.ID_PLACE = TUserCpart.ID_PLACE)',                 
                'TUm.UM_NAME','TCurrency.CURRENCY_NAME','TTypes.INFO', 't_product.PRODUCT_NAME'
                ])            
                ->join([
                    'TRequest' => [
                        'table' => 't_request',
                        'type' => 'LEFT',
                        'conditions' => [
                            'TRequest.ID_REQUEST = TTrade.ID_REQUEST'                           
                        ]
                    ],                
                    't_product' => [
                        'table' => 't_product',
                        'type' => 'LEFT',
                        'conditions' => [
                            'TRequest.ID_PRODUCT = t_product.ID_PRODUCT'                           
                        ]
                    ],                
                    't_market' => [
                        'table' => 't_market',
                        'type' => 'LEFT',
                        'conditions' => [
                            'TRequest.ID_MARKET = t_market.ID_MARKET'                           
                        ]
                    ]      
                        
                        ]
                );
            }else{
                $tTrade = "no user";
            }            
            
            $this->set(compact('tTrade'));
            //$this->set('tTrade', $tTrade);
            $this->set('_serialize', ['tTrade']);
            
        }else{
            $tTrade = "no delete";
            $this->set('tTrade', $tTrade);
            $this->set('_serialize', ['tTrade']);
    
        }

        //return $this->redirect(['action' => 'index']);
    }    

}