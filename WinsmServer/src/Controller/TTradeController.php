<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Model\Entity\TTrade;
use Cake\Datasource\ConnectionManager;

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
            $this->Auth->allow(['newTrade','find','confirmTrade','deleteTrade','page','resumen']);
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
        $conn = ConnectionManager::get('default');
        //if ($this->request->is('post')) {
            //var_dump($this->request->query);
            $newObjeto = [];
            foreach ($this->request->query as $key => $value) {
                # code...
                $newObjeto[$key] = $value;
            }    
           /* $stmt = $conn->execute('(SELECT CONCAT((SELECT t_product.ACRONYM FROM t_product WHERE t_product.ID_PRODUCT = (SELECT t_request.ID_PRODUCT FROM t_request WHERE t_request.ID_REQUEST = '.$newObjeto['ID_REQUEST'].' )),COUNT(t_request.ID_PRODUCT)+1,DATE_FORMAT(CURDATE(), "%y%m"),"-",'.$newObjeto['ID_USER_OWNER'].' ) AS cod FROM t_request WHERE t_request.ID_PRODUCT = (SELECT t_request.ID_PRODUCT FROM t_request  WHERE t_request.ID_REQUEST = '.$newObjeto['ID_REQUEST'].') GROUP BY t_request.ID_PRODUCT)');*/
            /*$stmt = $conn->execute('(SELECT CONCAT((SELECT t_product.ACRONYM FROM t_product WHERE t_product.ID_PRODUCT = (SELECT t_request.ID_PRODUCT FROM t_request WHERE t_request.ID_REQUEST = '.$newObjeto['ID_REQUEST'].' )),"-",DATE_FORMAT(CURDATE(), "%y%m") ) AS cod, (COUNT(t_request.ID_PRODUCT)+'.$newObjeto['ID_USER_OWNER'].') AS regs FROM t_request WHERE t_request.ID_PRODUCT = (SELECT t_request.ID_PRODUCT FROM t_request  WHERE t_request.ID_REQUEST = '.$newObjeto['ID_REQUEST'].') GROUP BY t_request.ID_PRODUCT)');*/
            $stmt = $conn->execute('SELECT t_request.ID_REQUEST, t_request.ID_PRODUCT, SUM(CASE WHEN (t_request.ID_REQUEST = t_trade.ID_REQUEST) THEN 1 ELSE 0 END) AS tratos, CONCAT((SELECT t_product.ACRONYM FROM t_product WHERE t_product.ID_PRODUCT = (SELECT t_request.ID_PRODUCT FROM t_request WHERE t_request.ID_REQUEST = t_trade.ID_REQUEST )),"-",DATE_FORMAT(CURDATE(), "%y%m") ) AS cod FROM t_request LEFT JOIN t_trade ON t_request.ID_REQUEST = t_trade.ID_REQUEST WHERE t_request.ID_PRODUCT = (SELECT t_request.ID_PRODUCT FROM t_request WHERE t_request.ID_REQUEST = '.$newObjeto['ID_REQUEST'].') GROUP BY t_request.ID_PRODUCT ORDER BY t_request.ID_PRODUCT');
            
            
            
            $results = $stmt ->fetchAll('assoc');
            $code = "";
            $nextCode = intval($results[0]['tratos']) + intval($newObjeto['ID_USER_OWNER']);
            if( $nextCode < 10){
                $code = $results[0]['cod']."00".$nextCode;
            }else{
                if($nextCode < 100){
                    $code = $results[0]['cod']."0".$nextCode;
                }else{
                    $code = $results[0]['cod']."".$nextCode;
                }
            } 
            
            $serverDate = date('Y-m-d H:i:s');       
            $newObjeto['ID_TP_STATUS_TRADE'] = 100;
            $newObjeto['CONFIRMED_OWNER'] = 1;
            $newObjeto['CONFIRMED_CPART'] = 0;
            $newObjeto['DH_CREATION'] = $serverDate;
            $newObjeto['COD_REF'] = $code;
            $tTrade = $this->TTrade->patchEntity($tTrade, $newObjeto);
            /*debug($tTrade);*/
            if ($this->TTrade->save($tTrade)) {
                $tableNotify = TableRegistry::get('TNotifications');
                $tNotification = $tableNotify->newEntity();     
                $tNotification->ID_TYPE_NOTIF = 150;
                $tNotification->ID_USER = $tTrade->ID_USER_CPART;
                $tNotification->DESCRIPTION = "Nuevo Negocio";
                $tNotification->READ_NOTIF = 0;
                $tNotification->DT_CREATED = $serverDate;  
                $tNotification->COD_REF = $tTrade->COD_REF;
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
                    'order' => ['TTypes.ORDER_INFO' => 'ASC',
                    "TRequest.ID_TP_OPERATION" => 'ASC',
                    "TRequest.ID_PRODUCT" => 'ASC',
                    "TRequest.DH_REQUEST" => 'ASC'
                    ],
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

            ->select(['TTrade.ID_TRADE', 'TTrade.COD_REF','TTrade.ID_REQUEST',
            'TTrade.ID_USER_OWNER', 'TTrade.ID_USER_CPART', 'TTrade.PRICE', 'TTrade.ID_TP_CURRENCY',
            'TTrade.QT', 'TTrade.ID_UM', 'TTrade.CONFIRMED_OWNER', 'TTrade.CONFIRMED_CPART',
            'TTrade.DH_CREATION', 'TTrade.ID_TP_STATUS_TRADE',
            'TRequest.DT_FROM','TRequest.DT_TO','BUSINESS' => '(SELECT INFO FROM t_types
            WHERE t_types.ID_TYPE = TRequest.ID_TP_BUSINESS)','OPERATION' => '(SELECT INFO FROM t_types
            WHERE t_types.ID_TYPE = TRequest.ID_TP_OPERATION)',
            'INFO1' => '(SELECT INFO1 FROM t_types
            WHERE t_types.ID_TYPE = TTrade.ID_TP_STATUS_TRADE)',
            'COLOR' => '(SELECT DATA_1 FROM t_types
            WHERE t_types.ID_TYPE = TTrade.ID_TP_STATUS_TRADE)',            
            'MARKET_NAME' => '(SELECT MARKET_NAME FROM t_market
            WHERE t_market.ID_MARKET = TRequest.ID_MARKET)','TRequest.LOC_DISTANCE',            
            'TUserOwer.MAIL','TUserOwer.NAME', 'TUserOwer.SURNAME','TUserOwer.PHONE_MOBILE_COUNTRY','TUserOwer.PHONE_MOBILE_NUM',
            'TUserOwer.PHONE_OTHER_COUNTRY','TUserOwer.PHONE_OTHER_NUM',
            'TUserCpart.MAIL','TUserCpart.NAME','TUserCpart.SURNAME','TUserCpart.PHONE_MOBILE_COUNTRY','TUserCpart.PHONE_MOBILE_NUM',
            'TUserCpart.PHONE_OTHER_COUNTRY','TUserCpart.PHONE_OTHER_NUM',
            'PLACE_CPART' => '(SELECT PLACE_NAME FROM t_locality
            WHERE t_locality.ID_PLACE = TUserCpart.ID_PLACE)',            
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
           /* debug($tTrade);*/
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
        $serverDate = date('Y-m-d H:i:s'); 
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
            $tNotification->ID_USER = $tTrade->ID_USER_CPART;
            $tNotification->DESCRIPTION = $descrip;
            $tNotification->READ_NOTIF = 0;
            $tNotification->DT_CREATED = $serverDate;
            $tNotification->COD_REF = $tTrade->COD_REF;
            //debug($tNotification);
            $tableNotify->save($tNotification);

    		$tTrade = $this->TTrade->find('all', array(
                    'order' => ['TTypes.ORDER_INFO' => 'ASC'],
                    'conditions' => array('TTrade.ID_TRADE' => $id
                    ),
                    'contain' => ['TRequest', 'TUserOwer','TUserCpart', 'TUm', 'TCurrency', 'TTypes']
            ))
            ->select(['TTrade.ID_TRADE','TTrade.COD_REF','TTrade.ID_REQUEST',
            'TTrade.ID_USER_OWNER', 'TTrade.ID_USER_CPART', 'TTrade.PRICE', 'TTrade.ID_TP_CURRENCY',
            'TTrade.QT', 'TTrade.ID_UM', 'TTrade.CONFIRMED_OWNER', 'TTrade.CONFIRMED_CPART',
            'TTrade.DH_CREATION', 'TTrade.ID_TP_STATUS_TRADE',
            'TRequest.DT_FROM','TRequest.DT_TO','BUSINESS' => '(SELECT INFO FROM t_types
            WHERE t_types.ID_TYPE = TRequest.ID_TP_BUSINESS)','OPERATION' => '(SELECT INFO FROM t_types
            WHERE t_types.ID_TYPE = TRequest.ID_TP_OPERATION)',
            'INFO1' => '(SELECT INFO1 FROM t_types
            WHERE t_types.ID_TYPE = TTrade.ID_TP_STATUS_TRADE)',
            'COLOR' => '(SELECT DATA_1 FROM t_types
            WHERE t_types.ID_TYPE = TTrade.ID_TP_STATUS_TRADE)',            
            'MARKET_NAME' => '(SELECT MARKET_NAME FROM t_market
            WHERE t_market.ID_MARKET = TRequest.ID_MARKET)','TRequest.LOC_DISTANCE',          
            'TUserOwer.MAIL','TUserOwer.NAME', 'TUserOwer.SURNAME','TUserOwer.PHONE_MOBILE_COUNTRY','TUserOwer.PHONE_MOBILE_NUM',
            'TUserOwer.PHONE_OTHER_COUNTRY','TUserOwer.PHONE_OTHER_NUM',
            'TUserCpart.MAIL','TUserCpart.NAME','TUserCpart.SURNAME','TUserCpart.PHONE_MOBILE_COUNTRY','TUserCpart.PHONE_MOBILE_NUM',
            'TUserCpart.PHONE_OTHER_COUNTRY','TUserCpart.PHONE_OTHER_NUM',
            'PLACE_CPART' => '(SELECT PLACE_NAME FROM t_locality
            WHERE t_locality.ID_PLACE = TUserCpart.ID_PLACE)',             
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
                        'order' => ['TTypes.ORDER_INFO' => 'ASC'],
                        'conditions' => array(
                            'OR' => array('TTrade.ID_USER_OWNER' => $user,'TTrade.ID_USER_CPART' => $user)
                        ),
                        'contain' => ['TRequest', 'TUserOwer','TUserCpart', 'TUm', 'TCurrency', 'TTypes']
                ))
                ->select(['TTrade.ID_TRADE','TTrade.COD_REF','TTrade.ID_REQUEST',
                'TTrade.ID_USER_OWNER', 'TTrade.ID_USER_CPART', 'TTrade.PRICE', 'TTrade.ID_TP_CURRENCY',
                'TTrade.QT', 'TTrade.ID_UM', 'TTrade.CONFIRMED_OWNER', 'TTrade.CONFIRMED_CPART',
                'TTrade.DH_CREATION', 'TTrade.ID_TP_STATUS_TRADE',
                'TRequest.DT_FROM','TRequest.DT_TO','BUSINESS' => '(SELECT INFO FROM t_types
                WHERE t_types.ID_TYPE = TRequest.ID_TP_BUSINESS)','OPERATION' => '(SELECT INFO FROM t_types
                WHERE t_types.ID_TYPE = TRequest.ID_TP_OPERATION)',
                'INFO1' => '(SELECT INFO1 FROM t_types
                WHERE t_types.ID_TYPE = TTrade.ID_TP_STATUS_TRADE)',
                'COLOR' => '(SELECT DATA_1 FROM t_types
                WHERE t_types.ID_TYPE = TTrade.ID_TP_STATUS_TRADE)',            
                'MARKET_NAME' => '(SELECT MARKET_NAME FROM t_market
                WHERE t_market.ID_MARKET = TRequest.ID_MARKET)', 'TRequest.LOC_DISTANCE',           
                'TUserOwer.MAIL','TUserOwer.NAME', 'TUserOwer.SURNAME','TUserOwer.PHONE_MOBILE_COUNTRY','TUserOwer.PHONE_MOBILE_NUM',
                'TUserOwer.PHONE_OTHER_COUNTRY','TUserOwer.PHONE_OTHER_NUM',
                'TUserCpart.MAIL','TUserCpart.NAME','TUserCpart.SURNAME','TUserCpart.PHONE_MOBILE_COUNTRY','TUserCpart.PHONE_MOBILE_NUM',
                'TUserCpart.PHONE_OTHER_COUNTRY','TUserCpart.PHONE_OTHER_NUM',
                'PLACE_CPART' => '(SELECT PLACE_NAME FROM t_locality
                WHERE t_locality.ID_PLACE = TUserCpart.ID_PLACE)',                 
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


    /**
     * Page method
     *
     * @param string|null $page user.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
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
                    'order' => ['TTypes.ORDER_INFO' => 'ASC',
                    "TRequest.ID_TP_OPERATION" => 'ASC',
                    "TRequest.ID_PRODUCT" => 'ASC',
                    "TRequest.DH_REQUEST" => 'ASC'
                    ],
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

            ->select(['TTrade.ID_TRADE','TTrade.COD_REF','TTrade.ID_REQUEST',
            'TTrade.ID_USER_OWNER', 'TTrade.ID_USER_CPART', 'TTrade.PRICE', 'TTrade.ID_TP_CURRENCY',
            'TTrade.QT', 'TTrade.ID_UM', 'TTrade.CONFIRMED_OWNER', 'TTrade.CONFIRMED_CPART',
            'TTrade.DH_CREATION', 'TTrade.ID_TP_STATUS_TRADE',
            'TRequest.DT_FROM','TRequest.DT_TO','BUSINESS' => '(SELECT INFO FROM t_types
            WHERE t_types.ID_TYPE = TRequest.ID_TP_BUSINESS)','OPERATION' => '(SELECT INFO FROM t_types
            WHERE t_types.ID_TYPE = TRequest.ID_TP_OPERATION)',
            'INFO1' => '(SELECT INFO1 FROM t_types
            WHERE t_types.ID_TYPE = TTrade.ID_TP_STATUS_TRADE)',
            'COLOR' => '(SELECT DATA_1 FROM t_types
            WHERE t_types.ID_TYPE = TTrade.ID_TP_STATUS_TRADE)',            
            'MARKET_NAME' => '(SELECT MARKET_NAME FROM t_market
            WHERE t_market.ID_MARKET = TRequest.ID_MARKET)','TRequest.LOC_DISTANCE',            
            'TUserOwer.MAIL','TUserOwer.NAME', 'TUserOwer.SURNAME','TUserOwer.PHONE_MOBILE_COUNTRY','TUserOwer.PHONE_MOBILE_NUM',
            'TUserOwer.PHONE_OTHER_COUNTRY','TUserOwer.PHONE_OTHER_NUM',
            'TUserCpart.MAIL','TUserCpart.NAME','TUserCpart.SURNAME','TUserCpart.PHONE_MOBILE_COUNTRY','TUserCpart.PHONE_MOBILE_NUM',
            'TUserCpart.PHONE_OTHER_COUNTRY','TUserCpart.PHONE_OTHER_NUM',
            'PLACE_CPART' => '(SELECT PLACE_NAME FROM t_locality
            WHERE t_locality.ID_PLACE = TUserCpart.ID_PLACE)',            
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
            )
            ->limit(10)
            ->page($page);            
            //debug($tTrade);
    		$count = $tTrade->count();
            if($count > 0){// si existe tTrade  
                $query = $this->TTrade->find('all', array(
                    'order' => ['TTypes.ORDER_INFO' => 'ASC'],
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
                });
                $count = $query->count();
                $resp = array();
                $resp["rows"] = $count;
                $resp["data"] = $tTrade;                   			 
                $this->set('tTrade', $resp);
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
            $conn = ConnectionManager::get('default'); 
            $stmt = $conn->execute('SELECT OPERATION,
            t_product__PRODUCT_NAME,
            TTrade__ID_TP_STATUS_TRADE,
            (SELECT INFO1 FROM t_types WHERE t_types.ID_TYPE = TTrade__ID_TP_STATUS_TRADE) INFO1,
            (SELECT DATA_1 FROM t_types WHERE t_types.ID_TYPE = TTrade__ID_TP_STATUS_TRADE) COLOR,
            SUM(TTrade__QT) QT_TOTAL,
            ROUND(AVG(TTrade__PRICE),0) PRICE_AVG_TOT,    
            COUNT(*) QTR
            FROM (select `ttrade`.`ID_TRADE` AS `TTrade__ID_TRADE`,`ttrade`.`ID_REQUEST` AS `TTrade__ID_REQUEST`,`ttrade`.`ID_USER_OWNER` AS `TTrade__ID_USER_OWNER`,`ttrade`.`ID_USER_CPART` AS `TTrade__ID_USER_CPART`,`ttrade`.`PRICE` AS `TTrade__PRICE`,`ttrade`.`ID_TP_CURRENCY` AS `TTrade__ID_TP_CURRENCY`,`ttrade`.`QT` AS `TTrade__QT`,`ttrade`.`ID_UM` AS `TTrade__ID_UM`,`ttrade`.`CONFIRMED_OWNER` AS `TTrade__CONFIRMED_OWNER`,`ttrade`.`CONFIRMED_CPART` AS `TTrade__CONFIRMED_CPART`,`ttrade`.`DH_CREATION` AS `TTrade__DH_CREATION`,`ttrade`.`ID_TP_STATUS_TRADE` AS `TTrade__ID_TP_STATUS_TRADE`,`trequest`.`DT_FROM` AS `TRequest__DT_FROM`,`trequest`.`DT_TO` AS `TRequest__DT_TO`,(select `t_types`.`INFO` from `t_types` where (`t_types`.`ID_TYPE` = `trequest`.`ID_TP_BUSINESS`)) AS `BUSINESS`,(select `t_types`.`INFO` from `t_types` where (`t_types`.`ID_TYPE` = `trequest`.`ID_TP_OPERATION`)) AS `OPERATION`,(select `t_types`.`INFO1` from `t_types` where (`t_types`.`ID_TYPE` = `ttrade`.`ID_TP_STATUS_TRADE`)) AS `INFO1`,(select `t_types`.`DATA_1` from `t_types` where (`t_types`.`ID_TYPE` = `ttrade`.`ID_TP_STATUS_TRADE`)) AS `COLOR`,(select `t_market`.`MARKET_NAME` from `t_market` where (`t_market`.`ID_MARKET` = `trequest`.`ID_MARKET`)) AS `MARKET_NAME`,`trequest`.`LOC_DISTANCE` AS `TRequest__LOC_DISTANCE`,`tuserower`.`MAIL` AS `TUserOwer__MAIL`,`tuserower`.`NAME` AS `TUserOwer__NAME`,`tuserower`.`SURNAME` AS `TUserOwer__SURNAME`,`tuserower`.`PHONE_MOBILE_COUNTRY` AS `TUserOwer__PHONE_MOBILE_COUNTRY`,`tuserower`.`PHONE_MOBILE_NUM` AS `TUserOwer__PHONE_MOBILE_NUM`,`tuserower`.`PHONE_OTHER_COUNTRY` AS `TUserOwer__PHONE_OTHER_COUNTRY`,`tuserower`.`PHONE_OTHER_NUM` AS `TUserOwer__PHONE_OTHER_NUM`,`tusercpart`.`MAIL` AS `TUserCpart__MAIL`,`tusercpart`.`NAME` AS `TUserCpart__NAME`,`tusercpart`.`SURNAME` AS `TUserCpart__SURNAME`,`tusercpart`.`PHONE_MOBILE_COUNTRY` AS `TUserCpart__PHONE_MOBILE_COUNTRY`,`tusercpart`.`PHONE_MOBILE_NUM` AS `TUserCpart__PHONE_MOBILE_NUM`,`tusercpart`.`PHONE_OTHER_COUNTRY` AS `TUserCpart__PHONE_OTHER_COUNTRY`,`tusercpart`.`PHONE_OTHER_NUM` AS `TUserCpart__PHONE_OTHER_NUM`,(select `t_locality`.`PLACE_NAME` from `t_locality` where (`t_locality`.`ID_PLACE` = `tusercpart`.`ID_PLACE`)) AS `PLACE_CPART`,`tum`.`UM_NAME` AS `TUm__UM_NAME`,`tcurrency`.`CURRENCY_NAME` AS `TCurrency__CURRENCY_NAME`,`ttypes`.`INFO` AS `TTypes__INFO`,`t_product`.`PRODUCT_NAME` AS `t_product__PRODUCT_NAME` from ((((((((`t_trade` `ttrade` left join `t_request` `trequest` on((`trequest`.`ID_REQUEST` = `ttrade`.`ID_REQUEST`))) left join `t_product` on((`trequest`.`ID_PRODUCT` = `t_product`.`ID_PRODUCT`))) left join `t_market` on((`trequest`.`ID_MARKET` = `t_market`.`ID_MARKET`))) left join `t_user` `tuserower` on((`tuserower`.`ID_USER` = `ttrade`.`ID_USER_OWNER`))) left join `t_user` `tusercpart` on((`tusercpart`.`ID_USER` = `ttrade`.`ID_USER_CPART`))) left join `t_um` `tum` on((`tum`.`ID_UM` = `ttrade`.`ID_UM`))) left join `t_currency` `tcurrency` on((`tcurrency`.`ID_CURRENCY` = `ttrade`.`ID_TP_CURRENCY`))) left join `t_types` `ttypes` on((`ttypes`.`ID_TYPE` = `ttrade`.`ID_TP_STATUS_TRADE`))) group by `ttrade`.`ID_TRADE`) VW_TRADE
            WHERE (TTrade__ID_USER_OWNER = '.$user.' 
            OR TTrade__ID_USER_CPART = '.$user.') 
            GROUP BY OPERATION, t_product__PRODUCT_NAME, TTrade__ID_TP_STATUS_TRADE');
            $results = $stmt ->fetchAll('assoc');
            $countR = count($results);
            if($countR > 0){// si existe results        
                $this->set('tTrade', $results);
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
    
        
}