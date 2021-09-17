<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TRelProdCurrency Controller
 *
 * @property \App\Model\Table\TRelProdCurrencyTable $TRelProdCurrency
 *
 * @method \App\Model\Entity\TRelProdCurrency[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TRelProdCurrencyController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		if($this->request->session()->check('Auth.TUser.token')){
            $this->Auth->allow(['findCurrency']);
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
        $tRelProdCurrency = $this->paginate($this->TRelProdCurrency);

        $this->set(compact('tRelProdCurrency'));
    }

    /**
     * View method
     *
     * @param string|null $id T Rel Prod Currency id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tRelProdCurrency = $this->TRelProdCurrency->get($id, [
            'contain' => []
        ]);

        $this->set('tRelProdCurrency', $tRelProdCurrency);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tRelProdCurrency = $this->TRelProdCurrency->newEntity();
        if ($this->request->is('post')) {
            $tRelProdCurrency = $this->TRelProdCurrency->patchEntity($tRelProdCurrency, $this->request->getData());
            if ($this->TRelProdCurrency->save($tRelProdCurrency)) {
                $this->Flash->success(__('The t rel prod currency has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t rel prod currency could not be saved. Please, try again.'));
        }
        $this->set(compact('tRelProdCurrency'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Rel Prod Currency id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tRelProdCurrency = $this->TRelProdCurrency->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tRelProdCurrency = $this->TRelProdCurrency->patchEntity($tRelProdCurrency, $this->request->getData());
            if ($this->TRelProdCurrency->save($tRelProdCurrency)) {
                $this->Flash->success(__('The t rel prod currency has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t rel prod currency could not be saved. Please, try again.'));
        }
        $this->set(compact('tRelProdCurrency'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Rel Prod Currency id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tRelProdCurrency = $this->TRelProdCurrency->get($id);
        if ($this->TRelProdCurrency->delete($tRelProdCurrency)) {
            $this->Flash->success(__('The t rel prod currency has been deleted.'));
        } else {
            $this->Flash->error(__('The t rel prod currency could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * findCurrency method
     *
     * @param string|null $type.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function findCurrency()
    {
    	$category = null;
    	if(!empty($this->request->query('category'))){
    		$category = $this->request->query('category');
    	}else{
    		if(!empty($this->request->query['category'])){
    			$category = $this->request->query['category'];
    		}
    	}
    	
    	if($category){
            $tRelProdCurrency = $this->TRelProdCurrency->find('all', array(
                'order' => [],
                'conditions' => array('TRelProdCurrency.ID_CATEGORY_PROD' => $category
                ),
                'joins' => array(
                    array(
                        'table' => 't_currency',
                        'alias' => 'TCurrency',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'TCurrency.ID_CURRENCY = TRelProdCurrency.ID_CURRENCY',
                        ),
                    )
                ),  
                'contain' => ['TCurrency']

            ))
            ->select(['TCurrency.ID_CURRENCY', 'TCurrency.CURRENCY_NAME']);
            //debug($tRequest);
            $count = $tRelProdCurrency->count();

    		if($count > 0){// si existe tipo
                $this->set(compact('tRelProdCurrency'));
                $this->set('_serialize', ['tRelProdCurrency']);      
    		}else{
    			$this->set('tRelProdCurrency', "CurrecnyNotExist");
    			$this->set('_serialize', ['tRelProdCurrency']);
    		}
    
    	}else{
    		$this->set('tRelProdCurrency', "CurrencyEmpty");
    		$this->set('_serialize', ['tRelProdCurrency']);
    	}
    	
    }      

}
