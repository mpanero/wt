<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TRelProdTypePrice Controller
 *
 * @property \App\Model\Table\TRelProdTypePriceTable $TRelProdTypePrice
 *
 * @method \App\Model\Entity\TRelProdTypePrice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TRelProdTypePriceController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		if($this->request->session()->check('Auth.TUser.token')){
            $this->Auth->allow(['findPrecRefe']);
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
        $tRelProdTypePrice = $this->paginate($this->TRelProdTypePrice);

        $this->set(compact('tRelProdTypePrice'));
    }

    /**
     * View method
     *
     * @param string|null $id T Rel Prod Type Price id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tRelProdTypePrice = $this->TRelProdTypePrice->get($id, [
            'contain' => []
        ]);

        $this->set('tRelProdTypePrice', $tRelProdTypePrice);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tRelProdTypePrice = $this->TRelProdTypePrice->newEntity();
        if ($this->request->is('post')) {
            $tRelProdTypePrice = $this->TRelProdTypePrice->patchEntity($tRelProdTypePrice, $this->request->getData());
            if ($this->TRelProdTypePrice->save($tRelProdTypePrice)) {
                $this->Flash->success(__('The t rel prod type price has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t rel prod type price could not be saved. Please, try again.'));
        }
        $this->set(compact('tRelProdTypePrice'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Rel Prod Type Price id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tRelProdTypePrice = $this->TRelProdTypePrice->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tRelProdTypePrice = $this->TRelProdTypePrice->patchEntity($tRelProdTypePrice, $this->request->getData());
            if ($this->TRelProdTypePrice->save($tRelProdTypePrice)) {
                $this->Flash->success(__('The t rel prod type price has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t rel prod type price could not be saved. Please, try again.'));
        }
        $this->set(compact('tRelProdTypePrice'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Rel Prod Type Price id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tRelProdTypePrice = $this->TRelProdTypePrice->get($id);
        if ($this->TRelProdTypePrice->delete($tRelProdTypePrice)) {
            $this->Flash->success(__('The t rel prod type price has been deleted.'));
        } else {
            $this->Flash->error(__('The t rel prod type price could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * findPrecRefe method
     *
     * @param string|null $type.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function findPrecRefe()
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
            $tRelProdTypePrice = $this->TRelProdTypePrice->find('all', array(
                'order' => [],
                'conditions' => array('TRelProdTypePrice.ID_CATEGORY_PROD' => $category
                ),
                'contain' => ['TTypes']

            ))
            ->select(['ID_TYPE_PRICE' => 'TTypes.ID_TYPE', 'TYPE_PRICE' => 'TTypes.INFO']);
            //debug($tRequest);
            $count = $tRelProdTypePrice->count();

    		if($count > 0){// si existe tipo
                $this->set(compact('tRelProdTypePrice'));
                $this->set('_serialize', ['tRelProdTypePrice']);      
    		}else{
    			$this->set('tRelProdTypePrice', "TypeNotExist");
    			$this->set('_serialize', ['tRelProdTypePrice']);
    		}
    
    	}else{
    		$this->set('tTypes', "TypeEmpty");
    		$this->set('_serialize', ['tTypes']);
    	}
    	
    }    
}
