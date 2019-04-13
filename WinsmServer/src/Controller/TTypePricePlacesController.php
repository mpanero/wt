<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TTypePricePlaces Controller
 *
 * @property \App\Model\Table\TTypePricePlacesTable $TTypePricePlaces
 *
 * @method \App\Model\Entity\TTypePricePlace[] paginate($object = null, array $settings = [])
 */
class TTypePricePlacesController extends AppController
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
        $tTypePricePlaces = $this->paginate($this->TTypePricePlaces);

        $this->set(compact('tTypePricePlaces'));
    }

    /**
     * View method
     *
     * @param string|null $id T Type Price Place id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tTypePricePlace = $this->TTypePricePlaces->get($id, [
            'contain' => []
        ]);

        $this->set('tTypePricePlace', $tTypePricePlace);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tTypePricePlace = $this->TTypePricePlaces->newEntity();
        if ($this->request->is('post')) {
            $tTypePricePlace = $this->TTypePricePlaces->patchEntity($tTypePricePlace, $this->request->getData());
            if ($this->TTypePricePlaces->save($tTypePricePlace)) {
                $this->Flash->success(__('The t type price place has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t type price place could not be saved. Please, try again.'));
        }
        $this->set(compact('tTypePricePlace'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Type Price Place id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tTypePricePlace = $this->TTypePricePlaces->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tTypePricePlace = $this->TTypePricePlaces->patchEntity($tTypePricePlace, $this->request->getData());
            if ($this->TTypePricePlaces->save($tTypePricePlace)) {
                $this->Flash->success(__('The t type price place has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t type price place could not be saved. Please, try again.'));
        }
        $this->set(compact('tTypePricePlace'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Type Price Place id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tTypePricePlace = $this->TTypePricePlaces->get($id);
        if ($this->TTypePricePlaces->delete($tTypePricePlace)) {
            $this->Flash->success(__('The t type price place has been deleted.'));
        } else {
            $this->Flash->error(__('The t type price place could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Find method
     *
     * @param string|null $id TTypePricePlaces id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function find()
    {
        $tTypePricePlaces = $this->TTypePricePlaces->find('all', array(
            'order' => array(),
            'conditions' => array("TTypePricePlaces.ID_TYPE_PRICE_INFO" => 301
        ),
            'contain' => []
        ))
        ->select(['t_places_price.ID_PLACE_PRICE',
        't_places_price.PLACE_NAME'
        ])            
        ->join([          
            't_places_price' => [
                'table' => 't_places_price',
                'type' => 'LEFT',
                'conditions' => [
                    'TTypePricePlaces.ID_PLACE_PRICE = t_places_price.ID_PLACE_PRICE',    
                    'TTypePricePlaces.ACTIVE' => 1
                ]
            ],                
        ]);/*
        ->where([
            "TTypePricePlaces.ID_TYPE_PRICE_INFO" => 301
        ]);*/
        //debug($tTypePricePlaces);
        $count = $tTypePricePlaces->count();
        if($count > 0){// si existe tTypePricePlaces    			 
            $this->set(compact('tTypePricePlaces'));
            $this->set('_serialize', ['tTypePricePlaces']);                
        }else{
            $data = "no data";
            $this->set('tTypePricePlaces', $data);
            $this->set('_serialize', ['tTypePricePlaces']); 
        }  
    }   
}
