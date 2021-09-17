<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\I18n\FrozenTime;
use Cake\I18n\Date;
use Cake\I18n\FrozenDate;
use Cake\Network\Exception\ForbiddenException;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
	 * User Id
	 */
	public $user_id;    

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        //Memory Session
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'MAIL',
                        'password' => 'PASSWORD'
                    ]
                ],                
                'ADmad/JwtAuth.Jwt' => [
                    'userModel' => 'TUser',
                    'fields' => [
                        'username' => 'MAIL'
                    ],

                    'parameter' => '_token',

                    // Boolean indicating whether the "sub" claim of JWT payload
                    // should be used to query the Users model and get user info.
                    // If set to `false` JWT's payload is directly returned.
                    'queryDatasource' => false,
                ]
            ],
            'storage' => 'Session',
            'unauthorizedRedirect' => false,
            'checkAuthIn' => 'Controller.initialize',

            // If you don't have a login action in your application set
            // 'loginAction' to false to prevent getting a MissingRouteException.
            'loginAction' => false,
            'loginRedirect' => false         
        ]);        

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    /**
     * Before filter logic
     *
     */
	public function beforeFilter(Event $event)
	{
       $this->user_id = $this->Auth->user('ID_USER');
       $token = $this->Auth->user('token');
	   // validate user token 
	   if($this->user_id){
	   		if(!$this->checkUserToken()){
	         	$this->Auth->logout(); // logout user 
	         	throw new ForbiddenException("Invalid Token! ".$token.";");     
	       	}else{
            }
	    }else{
        }
	}
    
    /**
     * Check User Token
     */
    public function checkUserToken() 
    {
            $request_token = $this->getRequestToken();
            if (!$request_token) {
               return false;
            }
            
            if ($request_token != $this->userToken()) {               
                return false;
            }
        return true;
    }
    
    /**
     * Get Request token
     */
    public function getRequestToken()
    {
    
    	$headers = $this->getHeaders();
    	if (!empty($headers)){
    		$token = explode(" ", $headers);
    		return $token[1];
    	}else{
    		return false;
    	}
    	
    }
    
    /**
     * Get Request headers
     */
    private function getHeaders()
    {
    	$headers = $this->request->header("Authorization");
    	return $headers;
    }
    
    /**
     * Get User token
     *
     */
    public function userToken()
    {
        return $this->Auth->user('token');
    }
    
    /**
     * Authorization default false
     */
    public function isAuthorized($user)
    {
        if(isset($user['sub'])){
            return true;
        }
        
        // Default deny
        return false;        
        
    }     
}
