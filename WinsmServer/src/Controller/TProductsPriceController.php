<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
/**
 * TProductsPrice Controller
 *
 * @property \App\Model\Table\TProductsPriceTable $TProductsPrice
 *
 * @method \App\Model\Entity\TProductsPrice[] paginate($object = null, array $settings = [])
 */
class TProductsPriceController extends AppController
{
	public function initialize()
	{
        parent::initialize();
		if($this->request->session()->read('Auth.TUser.token')){
            $this->Auth->allow(['getall','find','findPlace','findPosition','resumen']);
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
        $tProductsPrice = $this->paginate($this->TProductsPrice);

        $this->set(compact('tProductsPrice'));
    }

    /**
     * View method
     *
     * @param string|null $id T Products Price id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tProductsPrice = $this->TProductsPrice->get($id, [
            'contain' => []
        ]);

        $this->set('tProductsPrice', $tProductsPrice);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tProductsPrice = $this->TProductsPrice->newEntity();
        if ($this->request->is('post')) {
            $tProductsPrice = $this->TProductsPrice->patchEntity($tProductsPrice, $this->request->getData());
            if ($this->TProductsPrice->save($tProductsPrice)) {
                $this->Flash->success(__('The t products price has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t products price could not be saved. Please, try again.'));
        }
        $this->set(compact('tProductsPrice'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Products Price id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tProductsPrice = $this->TProductsPrice->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tProductsPrice = $this->TProductsPrice->patchEntity($tProductsPrice, $this->request->getData());
            if ($this->TProductsPrice->save($tProductsPrice)) {
                $this->Flash->success(__('The t products price has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t products price could not be saved. Please, try again.'));
        }
        $this->set(compact('tProductsPrice'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Products Price id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tProductsPrice = $this->TProductsPrice->get($id);
        if ($this->TProductsPrice->delete($tProductsPrice)) {
            $this->Flash->success(__('The t products price has been deleted.'));
        } else {
            $this->Flash->error(__('The t products price could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Find method
     *
     * @param string|null $id TProductsPrice id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function getall()
    {

        $tProductsPrice = $this->TProductsPrice->find('all', array(
                'order' => ['TProductsPrice.ORDER_INFO' => 'ASC'],
                'conditions' => array('TProductsPrice.ACTIVE' => 1),
                'contain' => []

        ));        
        //debug($tProductsPrice);
        $count = $tProductsPrice->count();
        if($count > 0){// si existe tProductsPrice  
            $this->set(compact('tProductsPrice'));
            $this->set('_serialize', ['tProductsPrice']);                
        }else{
            $data = "no data";
            $this->set('tProductsPrice', $data);
            $this->set('_serialize', ['tProductsPrice']); 
        }     

    }

    /**
     * Find method
     *
     * @param string|null $id TProductsPrice id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function find()
    {

        $tProductsPrice = $this->TProductsPrice->find('all', array(
                'order' => ['TProductsPrice.ORDER_INFO' => 'ASC'],
                'conditions' => array('TProductsPrice.ID_COUNTRY' => 1,'TProductsPrice.ACTIVE' => 1),
                'contain' => []

        ))
        ->select(['TProductsPrice.ID_PRODUCT_PRICE',
        'TProductsPrice.PRODUCT_NAME', 
        't_prices.ID_PRODUCT','t_prices.DATE_PRICE','t_prices.UPDATED'
        ])            
        ->join([          
            't_prices' => [
                'table' => 't_prices',
                'type' => 'LEFT',
                'conditions' => [
                    'TProductsPrice.ID_PRODUCT_PRICE = t_prices.ID_PRODUCT'                           
                ]
            ]     
                
                ]
        )
        ->group(['TProductsPrice.ID_PRODUCT_PRICE']);        
        //debug($tProductsPrice);
        $count = $tProductsPrice->count();
        if($count > 0){// si existe tProductsPrice  
            $this->set(compact('tProductsPrice'));
            $this->set('_serialize', ['tProductsPrice']);                
        }else{
            $data = "no data";
            $this->set('tProductsPrice', $data);
            $this->set('_serialize', ['tProductsPrice']); 
        }     

    }

    /**
     * Find method
     *
     * @param string|null $id TProductsPrice id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function findPlace()
    {
        $newObj = TableRegistry::get('TPrices');
        $newObj->alias('P');
        $subQuery = $newObj->find();

        $tProductsPrice = $this->TProductsPrice->find('all', array(
            'order' => array('t_places_price.ORDER_INFO', 't_prices.ID_PRODUCT ASC'),
            'conditions' => array('TProductsPrice.ID_COUNTRY' => 1,'TProductsPrice.ACTIVE' => 1,
            't_types.INFO' => 'PIZARRA', 't_prices.LAST' => 1
        ),
            'contain' => []

        ))
        ->select(['t_prices.ID_PRODUCT',
        'TProductsPrice.ID_PRODUCT_PRICE',
        'TProductsPrice.PRODUCT_NAME', 
        't_places_price.PLACE_NAME',
        't_prices.PRICE_VALUE',
        't_currency.CURRENCY_NAME',
        't_prices.VAR',
        't_prices.DATE_PRICE',
        't_prices.UPDATED'
        ])            
        ->join([          
            't_prices' => [
                'table' => 't_prices',
                'type' => 'LEFT',
                'conditions' => [
                    'TProductsPrice.ID_PRODUCT_PRICE = t_prices.ID_PRODUCT'                           
                ]
            ],                
            't_places_price' => [
                'table' => 't_places_price',
                'type' => 'LEFT',
                'conditions' => [
                    't_prices.ID_PLACE_PRICE = t_places_price.ID_PLACE_PRICE'                           
                ]
            ],                
            't_types' => [
                'table' => 't_types',
                'type' => 'LEFT',
                'conditions' => [
                    't_prices.ID_TYPE_PRICE_INFO = t_types.ID_TYPE'                           
                ]
            ],                
            't_currency' => [
                'table' => 't_currency',
                'type' => 'LEFT',
                'conditions' => [
                    't_prices.ID_TYPE_CURRENCY = t_currency.ID_CURRENCY'                           
                ]
            ]      
                
                ]
        )
        ->where([
            "t_prices.DATE_PRICE" => $subQuery
                ->select([$subQuery->func()->max('P.DATE_PRICE')])
                ->join([          
                    'T' => [
                        'table' => 't_types',
                        'type' => 'LEFT',
                        'conditions' => [
                            'T.ID_TYPE = P.ID_TYPE_PRICE_INFO'                           
                        ]
                    ]
                ])                
                ->where([
                    'T.INFO' => 'PIZARRA'
                ])
        ]);
        //debug($tProductsPrice);
        $count = $tProductsPrice->count();
        if($count > 0){// si existe tProductsPrice  
            $this->set(compact('tProductsPrice'));
            $this->set('_serialize', ['tProductsPrice']);                
        }else{
            $data = "no data";
            $this->set('tProductsPrice', $data);
            $this->set('_serialize', ['tProductsPrice']); 
        }     

    }

    /**
     * Find method
     *
     * @param string|null $id TProductsPrice id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function findPosition()
    {
        $newObj = TableRegistry::get('TPrices');
        $newObj->alias('P');
        $subQuery = $newObj->find();

        $tProductsPrice = $this->TProductsPrice->find('all', array(
            'order' => ['t_position.DATE_POSITION' => 'ASC'],
            'conditions' => array('TProductsPrice.ID_COUNTRY' => 1,'TProductsPrice.ACTIVE' => 1,
            't_types.INFO' => 'CHICAGO','t_prices.LAST' => 1
            
        ),
            'contain' => []

        ))
        ->select(['t_prices.ID_PRODUCT',
        'TProductsPrice.ID_PRODUCT_PRICE',
        'TProductsPrice.PRODUCT_NAME', 
        't_places_price.PLACE_NAME',
        't_position.POSITION',
        't_prices.PRICE_VALUE',
        't_currency.CURRENCY_NAME',
        't_prices.VAR',
        't_prices.DATE_PRICE',
        't_prices.UPDATED'
        ])            
        ->join([          
            't_prices' => [
                'table' => 't_prices',
                'type' => 'LEFT',
                'conditions' => [
                    'TProductsPrice.ID_PRODUCT_PRICE = t_prices.ID_PRODUCT'                           
                ]
            ],                
            't_places_price' => [
                'table' => 't_places_price',
                'type' => 'LEFT',
                'conditions' => [
                    't_prices.ID_PLACE_PRICE = t_places_price.ID_PLACE_PRICE'                           
                ]
            ],                
            't_types' => [
                'table' => 't_types',
                'type' => 'LEFT',
                'conditions' => [
                    't_prices.ID_TYPE_PRICE_INFO = t_types.ID_TYPE'                           
                ]
            ],                
            't_currency' => [
                'table' => 't_currency',
                'type' => 'LEFT',
                'conditions' => [
                    't_prices.ID_TYPE_CURRENCY = t_currency.ID_CURRENCY'                           
                ]
            ],
            't_position' => [
                'table' => 't_position',
                'type' => 'LEFT',
                'conditions' => [
                    't_prices.ID_POSITION = t_position.ID_POSITION'                           
                ]
            ],
                  
                
                ]
        )
        /*->where([
            "t_prices.DATE_PRICE" => '(SELECT max(DATE_PRICE) LAST_DATE_PRICE FROM t_prices P, t_types T WHERE P.ID_TYPE_PRICE_INFO = T.ID_TYPE AND T.INFO = "CHICAGO")'
        ]);*/        
        ->where([
            "t_prices.DATE_PRICE" => $subQuery
                ->select([$subQuery->func()->max('P.DATE_PRICE')])
                ->join([          
                    'T' => [
                        'table' => 't_types',
                        'type' => 'LEFT',
                        'conditions' => [
                            'T.ID_TYPE = P.ID_TYPE_PRICE_INFO'
                        ]
                    ]
                ])
                ->where([
                    'T.INFO' => 'CHICAGO'
                ])
        ]);
        //->group(['t_prices.ID_PRODUCT','t_position.POSITION']);
        //debug($tProductsPrice);
        $count = $tProductsPrice->count();
        if($count > 0){// si existe tProductsPrice  
            $this->set(compact('tProductsPrice'));
            $this->set('_serialize', ['tProductsPrice']);                
        }else{
            $data = "no data";
            $this->set('tProductsPrice', $data);
            $this->set('_serialize', ['tProductsPrice']); 
        }     


    }
    
    /**
     * resumen method
     *
     * @return \Cake\Network\Response|null
     */
    public function resumen()
    {

        $conn = ConnectionManager::get('default'); 
        $stmt = $conn->execute("SELECT TProductsPrice__PRODUCT_NAME,
        t_prices__UPDATED,
        t_prices__PRICE_VALUE,
        t_prices__VAR
        FROM (select `t_prices`.`ID_PRODUCT` AS `t_prices__ID_PRODUCT`,`tproductsprice`.`ID_PRODUCT_PRICE` AS `TProductsPrice__ID_PRODUCT_PRICE`,`tproductsprice`.`PRODUCT_NAME` AS `TProductsPrice__PRODUCT_NAME`,`t_places_price`.`PLACE_NAME` AS `t_places_price__PLACE_NAME`,`t_prices`.`PRICE_VALUE` AS `t_prices__PRICE_VALUE`,`t_currency`.`CURRENCY_NAME` AS `t_currency__CURRENCY_NAME`,`t_prices`.`VAR` AS `t_prices__VAR`,`t_prices`.`DATE_PRICE` AS `t_prices__DATE_PRICE`,`t_prices`.`UPDATED` AS `t_prices__UPDATED` from ((((`t_products_price` `tproductsprice` left join `t_prices` on((`tproductsprice`.`ID_PRODUCT_PRICE` = `t_prices`.`ID_PRODUCT`))) left join `t_places_price` on((`t_prices`.`ID_PLACE_PRICE` = `t_places_price`.`ID_PLACE_PRICE`))) left join `t_types` on((`t_prices`.`ID_TYPE_PRICE_INFO` = `t_types`.`ID_TYPE`))) left join `t_currency` on((`t_prices`.`ID_TYPE_CURRENCY` = `t_currency`.`ID_CURRENCY`))) where ((`tproductsprice`.`ID_COUNTRY` = 1) and (`tproductsprice`.`ACTIVE` = 1) and (`t_types`.`INFO` = 'PIZARRA') and (`t_prices`.`LAST` = 1) and (`t_prices`.`DATE_PRICE` = (select max(`p`.`DATE_PRICE`) from (`t_prices` `p` left join `t_types` `t` on((`t`.`ID_TYPE` = `p`.`ID_TYPE_PRICE_INFO`))) where (`t`.`INFO` = 'PIZARRA')))) ) VW
        WHERE t_places_price__PLACE_NAME = 'ROSARIO'");
        $results = $stmt ->fetchAll('assoc');
        $countR = count($results);
        if($countR > 0){// si existe results        
            $this->set('tProductsPrice', $results);
            $this->set('_serialize', ['tProductsPrice']);
        }else{
            $data = "no data";
            $this->set('tProductsPrice', $data);
            $this->set('_serialize', ['tProductsPrice']); 
        }  
          
    }    
    
    //-------------------------------------------------------------------------------
    public function dias_semana() {

        $year=date('Y'); 
        $month=date('m'); 
        $day=date('d');        
        
        # Obtenemos el d�a de la semana de la fecha dada 
        $diaSemana=date("w",mktime(0,0,0,$month,$day,$year)); 

        switch($diaSemana) {
            case 0:
                return $this->viernesP();
                break;
            case 1:
                return $this->lunesP();
                break;
            case 2:
                return $this->martesP();
                break;
            case 3:
                return $this->miercolesP();
                break;
            case 4:
                return $this->juevesP();
                break;
            case 5:
                return $this->viernesP();
                break;
            case 6:
                return $this->viernesP();
                break;


        }
        
    }    
    //-------------------------------------------------------------------------------
    public function lunesP() {
    
        $year=date('Y'); 
        $month=date('m'); 
        $day=date('d'); 
        # Obtenemos el numero de la semana 
        $semana=date("W",mktime(0,0,0,$month,$day,$year)); 
    
        # Obtenemos el d�a de la semana de la fecha dada 
        $diaSemana=date("w",mktime(0,0,0,$month,$day,$year)); 
    
        # el 0 equivale al domingo... 
        if($diaSemana==0) 
            $diaSemana=7; 
            
        # A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes 
        $primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));
        
        return $primerDia;
    
    }
    //-------------------------------------------------------------------------------
    public function martesP() {
    
        $year=date('Y'); 
        $month=date('m'); 
        $day=date('d'); 
        # Obtenemos el numero de la semana 
        $semana=date("W",mktime(0,0,0,$month,$day,$year)); 
    
        # Obtenemos el d�a de la semana de la fecha dada 
        $diaSemana=date("w",mktime(0,0,0,$month,$day,$year)); 
    
        # el 0 equivale al domingo... 
        if($diaSemana==0) 
            $diaSemana=7; 
            
        # A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes 
        $primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));
        
        # A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo 
        $segundoDia=date("Y-m-d",mktime(0,0,0,$month,$day+(2-$diaSemana),$year)); 
        
        return $segundoDia;
    
    }
    //-------------------------------------------------------------------------------
    public function miercolesP() {
    
        $year=date('Y'); 
        $month=date('m'); 
        $day=date('d'); 
        # Obtenemos el numero de la semana 
        $semana=date("W",mktime(0,0,0,$month,$day,$year)); 
    
        # Obtenemos el d�a de la semana de la fecha dada 
        $diaSemana=date("w",mktime(0,0,0,$month,$day,$year)); 
    
        # el 0 equivale al domingo... 
        if($diaSemana==0) 
            $diaSemana=7; 
            
        # A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes 
        $primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));
        
        # A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo 
        $segundoDia=date("Y-m-d",mktime(0,0,0,$month,$day+(3-$diaSemana),$year)); 
        
        return $segundoDia;
    
    }
    //-------------------------------------------------------------------------------
    public function juevesP() {
    
        $year=date('Y'); 
        $month=date('m'); 
        $day=date('d'); 
        # Obtenemos el numero de la semana 
        $semana=date("W",mktime(0,0,0,$month,$day,$year)); 
    
        # Obtenemos el d�a de la semana de la fecha dada 
        $diaSemana=date("w",mktime(0,0,0,$month,$day,$year)); 
    
        # el 0 equivale al domingo... 
        if($diaSemana==0) 
            $diaSemana=7; 
            
        # A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes 
        $primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));
        
        # A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo 
        $segundoDia=date("Y-m-d",mktime(0,0,0,$month,$day+(4-$diaSemana),$year)); 
        
        return $segundoDia;
    
    }
    //-------------------------------------------------------------------------------
    public function viernesP() {
    
        $year=date('Y'); 
        $month=date('m'); 
        $day=date('d'); 
        # Obtenemos el numero de la semana 
        $semana=date("W",mktime(0,0,0,$month,$day,$year)); 
    
        # Obtenemos el d�a de la semana de la fecha dada 
        $diaSemana=date("w",mktime(0,0,0,$month,$day,$year)); 
    
        # el 0 equivale al domingo... 
        if($diaSemana==0) 
            $diaSemana=7; 
            
        # A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes 
        $primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));
        
        # A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo 
        $segundoDia=date("Y-m-d",mktime(0,0,0,$month,$day+(5-$diaSemana),$year)); 
        
        return $segundoDia;
    }
    //-------------------------------------------------------------------------------
    public function sabadoP() {
    
        $year=date('Y'); 
        $month=date('m'); 
        $day=date('d'); 
        # Obtenemos el numero de la semana 
        $semana=date("W",mktime(0,0,0,$month,$day,$year)); 
    
        # Obtenemos el d�a de la semana de la fecha dada 
        $diaSemana=date("w",mktime(0,0,0,$month,$day,$year)); 
    
        # el 0 equivale al domingo... 
        if($diaSemana==0) 
            $diaSemana=7; 
            
        # A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes 
        $primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));
        
        # A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo 
        $segundoDia=date("Y-m-d",mktime(0,0,0,$month,$day+(6-$diaSemana),$year)); 
        
        return $segundoDia;
    }
    //-------------------------------------------------------------------------------
    public function domingoP() {
    
        $year=date('Y'); 
        $month=date('m'); 
        $day=date('d'); 
        # Obtenemos el numero de la semana 
        $semana=date("W",mktime(0,0,0,$month,$day,$year)); 
    
        # Obtenemos el d�a de la semana de la fecha dada 
        $diaSemana=date("w",mktime(0,0,0,$month,$day,$year)); 
    
        # el 0 equivale al domingo... 
        if($diaSemana==0) 
            $diaSemana=7; 
            
        # A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes 
        $primerDia=date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));
        
        # A la fecha recibida, le sumamos el dia de la semana menos siete y obtendremos el domingo 
        $segundoDia=date("Y-m-d",mktime(0,0,0,$month,$day+(7-$diaSemana),$year)); 
        
        return $segundoDia;
    }    

}
