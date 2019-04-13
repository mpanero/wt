<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * TMarket Controller
 *
 * @property \App\Model\Table\TMarketTable $TMarket
 *
 * @method \App\Model\Entity\TMarket[] paginate($object = null, array $settings = [])
 */
class TMarketController extends AppController
{

	public function initialize()
	{
		parent::initialize();	
		if($this->request->session()->check('Auth.TUser.token')){
            $this->Auth->allow(['index']);
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
        $tMarket = $this->paginate($this->TMarket);

        $this->set(compact('tMarket'));
    }

    /**
     * View method
     *
     * @param string|null $id T Market id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tMarket = $this->TMarket->get($id, [
            'contain' => []
        ]);

        $this->set('tMarket', $tMarket);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tMarket = $this->TMarket->newEntity();
        if ($this->request->is('post')) {
            $tMarket = $this->TMarket->patchEntity($tMarket, $this->request->getData());
            if ($this->TMarket->save($tMarket)) {
                $this->Flash->success(__('The t market has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t market could not be saved. Please, try again.'));
        }
        $this->set(compact('tMarket'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Market id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tMarket = $this->TMarket->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tMarket = $this->TMarket->patchEntity($tMarket, $this->request->getData());
            if ($this->TMarket->save($tMarket)) {
                $this->Flash->success(__('The t market has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t market could not be saved. Please, try again.'));
        }
        $this->set(compact('tMarket'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Market id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tMarket = $this->TMarket->get($id);
        if ($this->TMarket->delete($tMarket)) {
            $this->Flash->success(__('The t market has been deleted.'));
        } else {
            $this->Flash->error(__('The t market could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
