<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\I18n\Date;
/**
 * TNotifications Controller
 *
 * @property \App\Model\Table\TNotificationsTable $TNotifications
 *
 * @method \App\Model\Entity\TNotification[] paginate($object = null, array $settings = [])
 */
class TNotificationsController extends AppController
{
	public function initialize()
	{
        /*foreach (apache_request_headers() as $nombre => $valor) {
            echo "$nombre: $valor\n";
        }
        echo "HTTP_AUTHORIZATION:".$_SERVER['HTTP_AUTHORIZATION']."\n";
        */
        parent::initialize();
		if($this->request->session()->read('Auth.TUser.token')){
            $this->Auth->allow(['newNotify','find','readNotify','deleteNotify']);
			return true;
        }
        
        
        // accepts json
        //$this->RequestHandler->renderAs($this, 'json');
        
	}  
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $tNotifications = $this->paginate($this->TNotifications);

        $this->set(compact('tNotifications'));
    }

    /**
     * View method
     *
     * @param string|null $id T Notification id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tNotification = $this->TNotifications->get($id, [
            'contain' => []
        ]);

        $this->set('tNotification', $tNotification);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tNotification = $this->TNotifications->newEntity();
        if ($this->request->is('post')) {
            $tNotification = $this->TNotifications->patchEntity($tNotification, $this->request->getData());
            if ($this->TNotifications->save($tNotification)) {
                $this->Flash->success(__('The t notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t notification could not be saved. Please, try again.'));
        }
        $this->set(compact('tNotification'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Notification id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tNotification = $this->TNotifications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tNotification = $this->TNotifications->patchEntity($tNotification, $this->request->getData());
            if ($this->TNotifications->save($tNotification)) {
                $this->Flash->success(__('The t notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t notification could not be saved. Please, try again.'));
        }
        $this->set(compact('tNotification'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Notification id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tNotification = $this->TNotifications->get($id);
        if ($this->TNotifications->delete($tNotification)) {
            $this->Flash->success(__('The t notification has been deleted.'));
        } else {
            $this->Flash->error(__('The t notification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function newNotify()
    {
        $tNotification = $this->TNotifications->newEntity();
        //if ($this->request->is('post')) {
            //var_dump($this->request->query);
            //$tNotification = $this->TNotifications->patchEntity($tNotification, $this->request->query);
            $tNotification = $this->TNotifications->newEntity();
            $newObjeto = [];
            foreach ($this->request->query as $key => $value) {
                # code...
                //$newObjeto[$key] = $value;
                $tNotification->$key = $value;
            }              
            $tNotification->ACTIVE = 1;
            $tNotification->LOG = '';            
            $tNotification->DH_REQUEST = date("Y-m-d H:i:s");
            $tNotification->ID_TP_STATUS_REQ = 5;
            $tNotification->ID_TP_BUSINESS = 3;
            $dateF = new Date($tNotification->DT_FROM);
            $dateT = new Date($tNotification->DT_TO);
            $tNotification->DT_FROM = $dateF->format('Y-m-d');
            $tNotification->DT_TO = $dateT->format('Y-m-d');           
            //var_dump($tNotification);
            if ($this->TNotifications->save($tNotification)) {
                //debug($tNotification);
                //var_dump($this->TNotifications->getDataSource()->showLog());
                $this->set(compact('tNotification'));
                $this->set('_serialize', ['tNotification']);
            }else{
                $tNotification = "no save";
            }
            
            $this->Flash->error(__('The t request could not be saved. Please, try again.'));
            $this->set('tNotification', $tNotification);
            $this->set('_serialize', ['tNotification']);
        //}
    }

    /**
     * Find method
     *
     * @param string|null $id TNotifications id.
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

        $tNotification = $this->TNotifications->find('all', array(
                'order' => ['TNotifications.ID_NOTIF' => 'DESC'],
                'conditions' => array('TNotifications.READ_NOTIF' => 0,'TNotifications.ID_USER' => $user),
                'contain' => []

        ));
        //debug($tNotification);
        $count = $tNotification->count();
        if($count > 0){// si existe tNotification  
            //$key = $this->request->session()->read('Auth.TUser.token');
            // return Auth token
            //$this->response->header('token', "Bearer ".$key); 			 
            $this->set(compact('tNotification'));
            $this->set('_serialize', ['tNotification']);                
        }else{
            $data = "no data";
            $this->set('tNotification', $data);
            $this->set('_serialize', ['tNotification']); 
        }     

    } 
    /**
     * Edit method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function readNotify()
    {
    	$id = null;
    	if(!empty($this->request->query('ID_NOTIF'))){
    		$id = $this->request->query('ID_NOTIF');
    	}else{
    		if(!empty($this->request->query['ID_NOTIF'])){
    			$id = $this->request->query['ID_NOTIF'];
    		}else{
                if(!empty($this->request->data['ID_NOTIF'])){
                    $id = $this->request->data['ID_NOTIF'];
                }else{
                    if(!empty($this->request->data('ID_NOTIF'))){
                        $id = $this->request->data('ID_NOTIF');
                    }
                }
            }
        }

        $tNotification = $this->TNotifications->get($id, [
            'contain' => []
        ]);
        $tNotification = $this->TNotifications->patchEntity($tNotification, $this->request->query);
        $tNotification->READ_NOTIF = 1;
        $dateC = new Time($tNotification->DT_CREATED);
        $tNotification->DT_CREATED = $dateC->format('Y-m-d H:i:s');              
        //debug($tNotification);
        if ($this->TNotifications->save($tNotification)) {
            $tNotification = $this->TNotifications->get($id, [
                'contain' => []
            ]);            
        }else{
            $tNotification = "no update";
        }
        $this->set('tNotification', $tNotification);
        $this->set('_serialize', ['tNotification']);
    
    }                

    /**
     * Delete method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function deleteNotify()
    {
        $id = null;
        if(!empty($this->request->query('ID_NOTIF'))){
    		$id = $this->request->query('ID_NOTIF');
    	}else{
    		if(!empty($this->request->query['ID_NOTIF'])){
    			$id = $this->request->query['ID_NOTIF'];
    		}else{
                if(!empty($this->request->data['ID_NOTIF'])){
                    $id = $this->request->data['ID_NOTIF'];
                }else{
                    if(!empty($this->request->data('ID_NOTIF'))){
                        $id = $this->request->data('ID_NOTIF');
                    }
                }
            }
        }
        $tNotification = $this->TNotifications->get($id);
        if ($this->TNotifications->delete($tNotification)) {
            $tNotification = "1";
            $this->set(compact('tNotification'));
            $this->set('_serialize', ['tNotification']);
        } else {
            $tNotification = "0";
            $this->set(compact('tNotification'));
            $this->set('_serialize', ['tNotification']);
        }
    
    }       
}
