<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
/**
 * TChat Controller
 *
 * @property \App\Model\Table\TChatTable $TChat
 *
 * @method \App\Model\Entity\TChat[] paginate($object = null, array $settings = [])
 */
class TChatController extends AppController
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
            $this->Auth->allow(['newSMS', 'find', 'chatList', 'readSMS', 'deleteChat']);
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
        $tChat = $this->paginate($this->TChat);

        $this->set(compact('tChat'));
    }

    /**
     * View method
     *
     * @param string|null $id T Chat id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tChat = $this->TChat->get($id, [
            'contain' => []
        ]);

        $this->set('tChat', $tChat);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tChat = $this->TChat->newEntity();
        if ($this->request->is('post')) {
            $tChat = $this->TChat->patchEntity($tChat, $this->request->getData());
            if ($this->TChat->save($tChat)) {
                $this->Flash->success(__('The t chat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t chat could not be saved. Please, try again.'));
        }
        $this->set(compact('tChat'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Chat id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tChat = $this->TChat->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tChat = $this->TChat->patchEntity($tChat, $this->request->getData());
            if ($this->TChat->save($tChat)) {
                $this->Flash->success(__('The t chat has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t chat could not be saved. Please, try again.'));
        }
        $this->set(compact('tChat'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Chat id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tChat = $this->TChat->get($id);
        if ($this->TChat->delete($tChat)) {
            $this->Flash->success(__('The t chat has been deleted.'));
        } else {
            $this->Flash->error(__('The t chat could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function newSMS()
    {
        $tChat = $this->TChat->newEntity();
        //if ($this->request->is('post')) {
            //var_dump($this->request->query);
            //$tChat = $this->TChat->patchEntity($tChat, $this->request->query);
            $tChat = $this->TChat->newEntity();
            $newObjeto = [];
            foreach ($this->request->query as $key => $value) {
                # code...
                //$newObjeto[$key] = $value;
                $tChat->$key = $value;
            }              
            $tChat->DT_CREATED = date("Y-m-d H:i:s");
            //var_dump($tChat);
            if ($this->TChat->save($tChat)) {
                //debug($tChat);
                //var_dump($this->TChat->getDataSource()->showLog());
                $this->set(compact('tChat'));
                $this->set('_serialize', ['tChat']);
            }else{
                $tChat = "no save";
            }
            
            $this->Flash->error(__('The t request could not be saved. Please, try again.'));
            $this->set('tChat', $tChat);
            $this->set('_serialize', ['tChat']);
        //}
    }

    /**
     * Find method
     *
     * @param string|null $id TChat id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function find()
    {
    	$trade = null;
    	if(!empty($this->request->query('trade'))){
    		$trade = $this->request->query('trade');
    	}else{
    		if(!empty($this->request->query['trade'])){
    			$trade = $this->request->query['trade'];
    		}else{
                if(!empty($this->request->data['trade'])){
                    $trade = $this->request->data['trade'];
                }else{
                    if(!empty($this->request->data('trade'))){
                        $trade = $this->request->data('trade');
                    }
                }
            }
        }        

        $tChat = $this->TChat->find('all', array(
                'order' => ['TChat.DT_CREATED' => 'ASC'],
                'conditions' => array('TChat.ID_TRADE' => $trade),
                'contain' => ['TTrade']

        ));
        //debug($tChat);
        $count = $tChat->count();
        if($count > 0){// si existe tChat  
            //$key = $this->request->session()->read('Auth.TUser.token');
            // return Auth token
            //$this->response->header('token', "Bearer ".$key); 			 
            $this->set(compact('tChat'));
            $this->set('_serialize', ['tChat']);                
        }else{
            $data = "no data";
            $this->set('tChat', $data);
            $this->set('_serialize', ['tChat']); 
        }     

    } 


    /**
     * Find method
     *
     * @param string|null $id TChat id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function chatList()
    {
        $user = null;
        $conditions = array();
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
        
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute("SELECT GROUP_CONCAT(a.ID_CHAT SEPARATOR ',') AS CHATS FROM t_chat AS a WHERE (a.ID_USER_ORIGEN = $user OR a.ID_USER_DESTINY = $user) AND a.ID_CHAT = (SELECT b.ID_CHAT FROM t_chat AS b WHERE b.ID_TRADE = a.ID_TRADE ORDER BY b.ID_CHAT DESC LIMIT 1) ORDER BY a.DT_CREATED DESC;");
        $results = $stmt ->fetchAll('assoc');
        $ids = explode(',',$results[0]['CHATS']);
        
        $tChat = $this->TChat->find('all', array(
                'order' => ['TChat.DT_CREATED' => 'DESC'],
                'conditions' => ['TChat.ID_CHAT IN ' => $ids],
                'contain' => ['TTrade']

        ));
        $count = $tChat->count();
        
        //debug($tChat);
        if($count > 0){// si existe tChat  
            //$key = $this->request->session()->read('Auth.TUser.token');
            // return Auth token
            //$this->response->header('token', "Bearer ".$key); 			 
            $this->set(compact('tChat'));
            $this->set('_serialize', ['tChat']);                
        }else{
            $data = "no data";
            $this->set('tChat', $data);
            $this->set('_serialize', ['tChat']); 
        }     

    } 
    /**
     * Edit method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function readSMS()
    {
    	$id = null;
    	if(!empty($this->request->query('trade'))){
    		$id = $this->request->query('trade');
    	}else{
    		if(!empty($this->request->query['trade'])){
    			$id = $this->request->query['trade'];
    		}else{
                if(!empty($this->request->data['trade'])){
                    $id = $this->request->data['trade'];
                }else{
                    if(!empty($this->request->data('trade'))){
                        $id = $this->request->data('trade');
                    }
                }
            }
        }

        $TChat = TableRegistry::get("TChat");
        $query = $TChat->query();
        $result = $query->update()
                ->set(['READ_CHAT' =>  1])
                ->where(['ID_TRADE' => $id])
                ->execute();

        //debug($tChat);
        if ($result) {
            $tChat = "OK update";           
        }else{
            $tChat = "no update";
        }
        $this->set('tChat', $tChat);
        $this->set('_serialize', ['tChat']);
    
    }                

    /**
     * Delete method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function deleteChat()
    {
        $id = null;
        if(!empty($this->request->query('ID_CHAT'))){
    		$id = $this->request->query('ID_CHAT');
    	}else{
    		if(!empty($this->request->query['ID_CHAT'])){
    			$id = $this->request->query['ID_CHAT'];
    		}else{
                if(!empty($this->request->data['ID_CHAT'])){
                    $id = $this->request->data['ID_CHAT'];
                }else{
                    if(!empty($this->request->data('ID_CHAT'))){
                        $id = $this->request->data('ID_CHAT');
                    }
                }
            }
        }
        $tChat = $this->TChat->get($id);
        if ($this->TChat->delete($tChat)) {
            $tChat = "1";
            $this->set(compact('tChat'));
            $this->set('_serialize', ['tChat']);
        } else {
            $tChat = "0";
            $this->set(compact('tChat'));
            $this->set('_serialize', ['tChat']);
        }
    
    }     
}
