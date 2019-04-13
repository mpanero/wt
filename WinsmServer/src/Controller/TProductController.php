<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TProduct Controller
 *
 * @property \App\Model\Table\TProductTable $TProduct
 *
 * @method \App\Model\Entity\TProduct[] paginate($object = null, array $settings = [])
 */
class TProductController extends AppController
{
	
	public function initialize()
	{
		parent::initialize();
		if($this->request->session()->check('Auth.TUser.token')){
            $this->Auth->allow(['find']);
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
        $tProduct = $this->paginate($this->TProduct);

        $this->set(compact('tProduct'));
    }

    /**
     * View method
     *
     * @param string|null $id T Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tProduct = $this->TProduct->get($id, [
            'contain' => []
        ]);

        $this->set('tProduct', $tProduct);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tProduct = $this->TProduct->newEntity();
        if ($this->request->is('post')) {
            $tProduct = $this->TProduct->patchEntity($tProduct, $this->request->getData());
            if ($this->TProduct->save($tProduct)) {
                $this->Flash->success(__('The t product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t product could not be saved. Please, try again.'));
        }
        $this->set(compact('tProduct'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tProduct = $this->TProduct->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tProduct = $this->TProduct->patchEntity($tProduct, $this->request->getData());
            if ($this->TProduct->save($tProduct)) {
                $this->Flash->success(__('The t product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t product could not be saved. Please, try again.'));
        }
        $this->set(compact('tProduct'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tProduct = $this->TProduct->get($id);
        if ($this->TProduct->delete($tProduct)) {
            $this->Flash->success(__('The t product has been deleted.'));
        } else {
            $this->Flash->error(__('The t product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Find method
     *
     * @param string|null $id T Product id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function find()
    {
    	$tProduct = null;
    	if(!empty($this->request->query('tp'))){
    		$tProduct = $this->request->query('tp');
    	}else{
    		if(!empty($this->request->query['tp'])){
    			$tProduct = $this->request->query['tp'];
    		}
        } 
        
    	$market = null;
    	if(!empty($this->request->query('mk'))){
    		$market = $this->request->query('mk');
    	}else{
    		if(!empty($this->request->query['mk'])){
    			$market = $this->request->query['mk'];
    		}
        }         

        if($tProduct && $market){
    		$product = $this->TProduct->find('all', array(
                    'conditions' => array('TProduct.ID_MARKET' => strtoupper($market),
                        'TProduct.ID_CATEGORY_PROD' => strtoupper($tProduct),
    					'TProduct.ACTIVE' => 1
    				)
            ));

    		$count = $product->count();
    		if($count > 0){// si existe products    			 
                $tProduct = $product;
                $this->set(compact('tProduct'));
                $this->set('_serialize', ['tProduct']);                
            }else{
                $data = "no data";
                $this->set('tProduct', $data);
                $this->set('_serialize', ['tProduct']); 
            }     

        }else{
            $data = "null params";
            $this->set('tProduct', $data);
            $this->set('_serialize', ['tProduct']);
        }
    }
    
}
