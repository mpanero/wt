<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
use Cake\Network\Exception\UnauthorizedException;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\Mailer\Email;

/**
 * TUser Controller
 *
 * @property \App\Model\Table\TUserTable $TUser
 *
 * @method \App\Model\Entity\TUser[] paginate($object = null, array $settings = [])
 */
class TUserController extends AppController
{

	
	public function initialize()
	{
        parent::initialize();
		if($this->request->session()->read('Auth.TUser.token')){
            $this->Auth->allow(['editUser', 'page', 'logout']);
			return true;
        }else{
            $this->Auth->allow(['login', 'logout', 'newUser','addUser', 'sendmail','confirmUser','newPass','findUsers']); //El uso de AuthComponent estándar permite que la lógica permita el acceso no autenticado a las acciones / add y / token
			return true;
        }       
    }

	public function login(){
        //$this->request->session()->destroy();
		if($this->request->session()->check('Auth.TUser.token')){
            $key = $this->request->session()->read('Auth.TUser.token');
            $alg['alg'] = "HS256";
            $token = JWT::decode($key,Security::salt(),array($alg['alg']));            
            $user = $this->request->session()->read('Auth.TUser.user');
            $sub = $this->request->session()->read('Auth.TUser.user');
			$info = array('token' => $this->request->session()->read('Auth.TUser.token'),
                    'success' => true,
                    'user' => $token->user,
                    'sub' => $token->sub,
                    'role' => $token->role,
                    'allReady' => 1
			);
			$this->set('login', $info);
			$this->set('_serialize', ['login']);
		}else{
			//if($this->request->is('post')) {
                $user = null;
                if(!empty($this->request->query('username'))){
                    $user = $this->request->query('username');
                }else{
                    if(!empty($this->request->query['username'])){
                        $user = $this->request->query['username'];
                    }else{
                        if(!empty($this->request->data['username'])){
                            $user = $this->request->data['username'];
                        }else{
                            if(!empty($this->request->data('username'))){
                                $user = $this->request->data('username');
                            }
                        }
                    }
                }

                $pass = null;
                if(!empty($this->request->query('password'))){
                    $pass = $this->request->query('password');
                }else{
                    if(!empty($this->request->query['password'])){
                        $pass = $this->request->query['password'];
                    }else{
                        if(!empty($this->request->data['password'])){
                            $pass = $this->request->data['password'];
                        }else{
                            if(!empty($this->request->data('password'))){
                                $pass = $this->request->data('password');
                            }
                        }
                    }
                }                

                $auth = $this->TUser->find('all', array('conditions' => array('TUser.ACTIVE ' => 1, 'TUser.PASSWORD ' => Security::hash($pass,"SHA256",true), 'TUser.MAIL' => $user)))
                ->select(['TUser.ID_USER','TUser.MAIL','TUser.NAME','TUser.SURNAME','TUser.ID_ROL','TUser.ACTIVE'])
                ->first();
                //var_dump($auth);
                //debug($auth);
                //$md5 = Security::hash($pass,"SHA256",true);
                //echo $user.":".$pass.":".$md5;
                //$this->set('login', $user.":".$pass.":".$md5);
                //$this->set('_serialize', ['login']);                
                //$auth = $this->Auth->identify();
                if ($auth) {
                    /*$this->auth = new JwtAuthenticate($this->Registry, [
                        'userModel' => 'TUser',
                    ]);*/						
					// Generate user Auth token
					$token = JWT::encode(
							[
                                'sub' => $auth->ID_USER,
                                'user' => $auth->NAME,
                                'role' => $auth->ID_ROL,
                                'exp' => time() + 3700,
                                'iat' => time(),
                                'iss' => 'Auth'
							],
                            Security::salt(),
                            'HS256'
							);
					
                    $info = array(
                            'sub' => $auth->ID_USER,
                            'user' => $auth->NAME." ".$auth->SURNAME,
                            'role' => $auth->ID_ROL,
							'token' => $token,
							'success' => true
					);
                    $data = array('TUser' => array('id' => $auth->ID_USER, 'sub' => $auth->ID_USER, 'user' => $auth->MAIL, 'role' => $auth->ID_ROL, 'token' => $token));
					// Set Storage
                    $this->Auth->setUser($data);
                    					
					// Add user token into Auth session
                    $this->request->session()->write('Auth.TUser.token', $token);

					// Add user User into Auth session
					$this->request->session()->write('Auth.TUser.user', $auth->ID_USER);                    
					
					// return Auth token
                    //$this->response->header('WWW-Authenticate', "xBasic realm=\"".$token."\"");

                    // return Auth token
                    $this->response->header('Authorization', 'Bearer ' . $token);

                    // return Auth token
                    //$this->response->header('token', 'Bearer ' . $token);

					// return Auth User
                    $this->set('authUser', $this->Auth->user());

                    // Active Auth User Login
                    $this->Auth->redirectUrl(); 
                    
					$this->set('login', $info);
                    $this->set('_serialize', ['login']);
                    
				} else {
					//throw new NotAcceptableException(__('Email or password is wrong.'));
					$this->set('login', "usuario/contrase&ntilde;a incorrectos");
					$this->set('_serialize', ['login']);
				} 
			/*}else{
				$this->set('login', "unauthorized");
				$this->set('_serialize', ['login']);
			}*/
		}
	}

	/**
	 * Logout user
	 * API URL  /api/login method: DELETE
	 * @return json response
	 */
	public function logout()
	{
        $this->Auth->logout();
        $this->request->session()->destroy();
        $this->set('login', 'loggedOut');
		$this->set('_serialize', ['login']);
	}
    

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $tUser = $this->paginate($this->TUser);

        $this->set(compact('tUser'));
    }

    /**
     * View method
     *
     * @param string|null $id T User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tUser = $this->TUser->get($id, [
            'contain' => []
        ]);

        $this->set('tUser', $tUser);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tUser = $this->TUser->newEntity();
        if ($this->request->is('post')) {
            $tUser = $this->TUser->patchEntity($tUser, $this->request->getData());
            if ($this->TUser->save($tUser)) {
                $this->Flash->success(__('The t user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t user could not be saved. Please, try again.'));
        }
        $this->set(compact('tUser'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tUser = $this->TUser->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tUser = $this->TUser->patchEntity($tUser, $this->request->getData());
            if ($this->TUser->save($tUser)) {
                $this->Flash->success(__('The t user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t user could not be saved. Please, try again.'));
        }
        $this->set(compact('tUser'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tUser = $this->TUser->get($id);
        if ($this->TUser->delete($tUser)) {
            $this->Flash->success(__('The t user has been deleted.'));
        } else {
            $this->Flash->error(__('The t user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function newUser()
    {
        $tUser = $this->TUser->newEntity();
        if ($this->request->is('post')) {
            
            //var_dump($this->request->query);
            //$tUser = $this->TUser->patchEntity($tUser, $this->request->query);
            foreach ($this->request->query as $key => $value) {
                # code...
                $tUser->$key = $value;
            }  
            $tUser->ID_ROL = 2;            
            $tUser->ACTIVE = 0;
            $dateB = new Date($tUser->BIRTHDATE);
            
            $tUser->BIRTHDATE = $dateB->format('Y-m-d');
            $passW = $tUser->PASSWORD;
            $tUser->PASSWORD = Security::hash($tUser->PASSWORD,"SHA256",true);                       
            //var_dump($tUser);
            if ($this->TUser->save($tUser)) {
                //debug($tUser);
                $tUser->PASSWORD = $passW;
                if($this->sendmail($tUser)){
                    $this->set(compact('tUser'));
                    $this->set('_serialize', ['tUser']);
                }else{
                    $this->set('tUser', "CorreoNoEnviado");
                    $this->set('_serialize', ['tUser']);
                }
            }else{
                $tUser = "no save";
                $this->set('tUser', $tUser);
                $this->set('_serialize', ['tUser']);                
            }
            
            //$this->Flash->error(__('The t request could not be saved. Please, try again.'));
            ///$this->set('tUser', $tUser);
            //$this->set('_serialize', ['tUser']);
        }
        $this->set(compact('tUser'));
    }    

    /**
     * Send Mail method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function sendmail($user)
    {        

        $email = new Email();
        $email->subject('Activacion de Usuario Startrade');
        $email->emailFormat('html');
        $email->to($user->MAIL);
        $email->from('user.confirm@smartradeagro.com');

        $userArray = [
            'NAME' => $user->NAME, 
            'SURNAME' => $user->SURNAME,
            'PASSWORD' => $this->request->query['PASSWORD'],
            'MAIL' => $user->MAIL,
            'PHONE_MOBILE_COUNTRY' => $user->PHONE_MOBILE_COUNTRY,
            'PHONE_MOBILE_NUM' => $user->PHONE_MOBILE_NUM,
            'TOKEN' => JWT::encode(
                [
                    'sub' => $user->ID_USER,
                    'exp' => time() + 604800,
                    'iat' => time(),
                    'iss' => 'JwtAuth.Jwt'
                ],
                Security::salt(),
                'HS256'
                )
        ];
        $email->viewVars($userArray);
        $email->template('registroview', 'registrotemplate');
        //$email->send();
        try {
            if ($email->send()) {
                return true ;
            } else {
                return false ;
            }
        } catch ( Exception $e ) {
            /*echo $e->getMessage();*/
            return false ;
        }        
                

    }   

    /**
     * Confirmar Usuario method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function confirmUser()
    {        
        $key = null;
        if(!empty($this->request->query('v'))){
            $key = $this->request->query('v');
        }else{
            if(!empty($this->request->query['v'])){
                $key = $this->request->query['v'];
            }else{
                if(!empty($this->request->data['v'])){
                    $key = $this->request->data['v'];
                }else{
                    if(!empty($this->request->data('v'))){
                        $key = $this->request->data('v');
                    }
                }
            }
        }
        $alg['alg'] = "HS256";
        $token = JWT::decode($key,Security::salt(),array($alg['alg']));
        $sub = $token->sub;
        $exp = $token->exp;    
        //var_dump($token);  
        $tUser = $this->TUser->get($sub, [
            'contain' => []
        ]); 
            
        if($exp < (time() + 604800)){
            if($tUser){// si existe usuario
                $tUser->ACTIVE = 1;
                if ($this->TUser->save($tUser)) {
                    $this->set('tUser', 1);
                    $this->set('_serialize', ['tUser']);
                }else{
                    $this->set('tUser', 2);
                    $this->set('_serialize', ['tUser']);                
                }
                            
            }else{
                $this->set('tUser', 0);
                $this->set('_serialize', ['tUser']);
            } 

        }else{
            $this->set('tUser', 3);
            $this->set('_serialize', ['tUser']);            
        }        

    }       

    /**
     * Pass New Usuario method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function newPass()
    {        
        if ($this->request->is('post')) {
            $mail = null;
            $conditions = array();
            if(!empty($this->request->query('MAIL'))){
                $mail = $this->request->query('MAIL');
            }else{
                if(!empty($this->request->query['MAIL'])){
                    $mail = $this->request->query['MAIL'];
                }
            }

            $pass = null;
            if(!empty($this->request->query('PASSWORD'))){
                $pass = $this->request->query('PASSWORD');
            }else{
                if(!empty($this->request->query['PASSWORD'])){
                    $pass = $this->request->query['PASSWORD'];
                }
            }            

            $conditions["TUser.MAIL ="] = $mail;

            $data = $this->TUser->find('all', array(
                    'order' => ['TUser.ID_USER' => 'ASC'],
                    'conditions' => $conditions,
                    'contain' => []

            ));
            $tUser = $data->first();
            //debug($tUser);   
            //$count = $tUser->count();
            if($tUser){// si existe tUser               
                $tUser->ACTIVE = 0;
                $tUser->PASSWORD = Security::hash($pass,"SHA256",true);                       
                
                if ($this->TUser->save($tUser)) {
                    //debug($tUser);
                    if($this->sendmail($tUser)){
                        $this->set(compact('tUser'));
                        $this->set('_serialize', ['tUser']);
                    }else{
                        $this->set('tUser', "CorreoNoEnviado");
                        $this->set('_serialize', ['tUser']);
                    }
                    
                }else{
                    $tUser = "Contrase&ntilde;a no Actualizada";
                    $this->set('tUser', $tUser);
                    $this->set('_serialize', ['tUser']);                
                }
                
            }else{
                $tUser = "Email no registrado";
                $this->set('tUser', $tUser);
                $this->set('_serialize', ['tUser']);                 
            }

        }
        $this->set(compact('tUser'));       

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
            $tUser = $this->TUser->find('all', array(
                'order' => ['TUser.ID_USER' => 'DESC'],
                'conditions' => [],
                'contain' => ['TPlace', 'TGender']
            ))            
            ->limit(10)
            ->page($page);
    		$countR = $tUser->count();
            if($countR > 0){// si existe tUser 
                $query = $this->TUser->find('all', array(
                    'order' => ['TUser.ID_USER' => 'DESC'],
                    'conditions' => [],
                    'contain' => ['TPlace','TGender']
                ));
                $count = $query->count();
                $resp = array();
                $resp["rows"] = $count;
                $resp["data"] = $tUser;        
                $this->set('tUser', $resp);
                $this->set('_serialize', ['tUser']);
            }else{
                $data = "no data";
                $this->set('tUser', $data);
                $this->set('_serialize', ['tUser']); 
            }  

        }else{
            $data = "null params";
            $this->set('tUser', $data);
            $this->set('_serialize', ['tUser']);
        }            
    } 
    

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addUser()
    {
        $tUser = $this->TUser->newEntity();
        if ($this->request->is('post')) {
            
            //var_dump($this->request->query);
            //$tUser = $this->TUser->patchEntity($tUser, $this->request->query);
            foreach ($this->request->query as $key => $value) {
                # code...
                $pos = strpos($key, '_submit');                
                if($pos !== false){
                    $data = explode("_submit",$key);
                    $propiedad = $data[0];
                    $tUser->$propiedad = $value;
                }else{
                    if($key == "ACTIVITY"){
                        $tUser->$key = implode(",", $value);
                    }else{
                        $tUser->$key = $value;
                    }
                    
                }
                
            }              
            $tUser->ID_ROL = 2;
            $tUser->ACTIVE = 1;
            $tUser->ID_TYPE_STATUS_USER = 320;
            
            $dateB = new Date($tUser->BIRTHDATE);
            
            $tUser->BIRTHDATE = $dateB->format('Y-m-d');
            $passW = $tUser->PASSWORD;
            $tUser->PASSWORD = Security::hash($tUser->PASSWORD,"SHA256",true);                       
            //var_dump($tUser);
            if ($this->TUser->save($tUser)) {
                //debug($tUser);
                $tUser->PASSWORD = $passW;
                $this->set(compact('tUser'));
                $this->set('_serialize', ['tUser']);
            }else{
                $tUser = "no save";
                $this->set('tUser', $tUser);
                $this->set('_serialize', ['tUser']);                
            }

        }
        $this->set(compact('tUser'));
    }     

    /**
     * Edit method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function editUser()
    {
    	$id = null;
    	if(!empty($this->request->query('ID_USER'))){
    		$id = $this->request->query('ID_USER');
    	}else{
    		if(!empty($this->request->query['ID_USER'])){
    			$id = $this->request->query['ID_USER'];
    		}else{
                if(!empty($this->request->data['ID_USER'])){
                    $id = $this->request->data['ID_USER'];
                }else{
                    if(!empty($this->request->data('ID_USER'))){
                        $id = $this->request->data('ID_USER');
                    }
                }
            }
        }

        $tUser = $this->TUser->get($id, [
            'contain' => ['TPlace', 'TUserRoles']
        ]);
        $tUser = $this->TUser->newEntity();
        $newObjeto = [];
        foreach ($this->request->query as $key => $value) {
            # code...
            /** $newObjeto[$key] = $value; **/
            $pos = strpos($key, '_submit');                
            if($pos !== false){
                $data = explode("_submit",$key);
                $propiedad = $data[0];
                $tUser->$propiedad = $value;
            }else{
                if($key == "ACTIVITY"){
                    $tUser->$key = implode(",", $value);
                }else{
                    $tUser->$key = $value;
                }
                
            }            
        }        
        
        $dateF = new Time($tUser->BIRTHDATE);
        $tUser->BIRTHDATE = $dateF->format('Y-m-d');
        
        /*debug($tUser);*/
        if ($this->TUser->save($tUser)) {
            $tUser = $this->TUser->get($id, [
                'contain' => ['TPlace', 'TUserRoles']
            ]);            
            $this->set(compact('tUser'));
            $this->set('_serialize', ['tUser']);
        }else{
            $tUser = "no update";
        }
        $this->set('tUser', $tUser);
        $this->set('_serialize', ['tUser']);
    
    }

    /**
     * Page method
     *
     * @return \Cake\Network\Response|null
     */
    public function findUsers()
    {
        $tUser = $this->TUser->find('all', array(
            'order' => ['TUser.MAIL' => 'ASC'],
            'conditions' => [],
            'contain' => []
        ))->select(['TUser.MAIL']);            
        $countR = $tUser->count();
        if($countR > 0){// si existe tUser 
            $this->set('tUser', $tUser);
            $this->set('_serialize', ['tUser']);
        }else{
            $data = "no data";
            $this->set('tUser', $data);
            $this->set('_serialize', ['tUser']); 
        }             
    }     

}
