<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TRelProdUm Controller
 *
 * @property \App\Model\Table\TRelProdUmTable $TRelProdUm
 *
 * @method \App\Model\Entity\TRelProdUm[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TRelProdUmController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		if($this->request->session()->check('Auth.TUser.token')){
            $this->Auth->allow(['findUM']);
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
        $tRelProdUm = $this->paginate($this->TRelProdUm);

        $this->set(compact('tRelProdUm'));
    }

    /**
     * View method
     *
     * @param string|null $id T Rel Prod Um id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tRelProdUm = $this->TRelProdUm->get($id, [
            'contain' => []
        ]);

        $this->set('tRelProdUm', $tRelProdUm);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tRelProdUm = $this->TRelProdUm->newEntity();
        if ($this->request->is('post')) {
            $tRelProdUm = $this->TRelProdUm->patchEntity($tRelProdUm, $this->request->getData());
            if ($this->TRelProdUm->save($tRelProdUm)) {
                $this->Flash->success(__('The t rel prod um has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t rel prod um could not be saved. Please, try again.'));
        }
        $this->set(compact('tRelProdUm'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Rel Prod Um id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tRelProdUm = $this->TRelProdUm->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tRelProdUm = $this->TRelProdUm->patchEntity($tRelProdUm, $this->request->getData());
            if ($this->TRelProdUm->save($tRelProdUm)) {
                $this->Flash->success(__('The t rel prod um has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t rel prod um could not be saved. Please, try again.'));
        }
        $this->set(compact('tRelProdUm'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Rel Prod Um id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tRelProdUm = $this->TRelProdUm->get($id);
        if ($this->TRelProdUm->delete($tRelProdUm)) {
            $this->Flash->success(__('The t rel prod um has been deleted.'));
        } else {
            $this->Flash->error(__('The t rel prod um could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * findUM method
     *
     * @param string|null $type.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function findUM()
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
            $tRelProdUm = $this->TRelProdUm->find('all', array(
                'order' => [],
                'conditions' => array('TRelProdUm.ID_CATEGORY_PROD' => $category
                ),
                'joins' => array(
                    array(
                        'table' => 't_um',
                        'alias' => 'TUm',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'TUm.ID_UM = TRelProdUm.ID_UM',
                        ),
                    )
                ),                 
                'contain' => ['TUm']

            ))
            ->select(['TUm.ID_UM', 'TUm.UM_NAME']);
            //debug($tRequest);
            $count = $tRelProdUm->count();

    		if($count > 0){// si existe tipo
                $this->set(compact('tRelProdUm'));
                $this->set('_serialize', ['tRelProdUm']);      
    		}else{
    			$this->set('tRelProdUm', "UmNotExist");
    			$this->set('_serialize', ['tRelProdUm']);
    		}
    
    	}else{
    		$this->set('tRelProdUm', "UmEmpty");
    		$this->set('_serialize', ['tRelProdUm']);
    	}
    	
    }     

}
