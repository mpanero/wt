<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Error\Debugger;
use Cake\Datasource;
use Cake\Core\StaticConfigTrait;
use Cake\I18n\Time;
use Cake\I18n\Date;

/**
 * TProvince Controller
 *
 * @property \App\Model\Table\TProvinceTable $TProvince
 *
 * @method \App\Model\Entity\TProvince[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TProvinceController extends AppController
{
	public function initialize()
	{
        parent::initialize();
		if($this->request->session()->read('Auth.TUser.token')){
            $this->Auth->allow(['view', 'add', 'edit','delete']);
			return true;
        }else{
            $this->Auth->allow(['index']); //El uso de AuthComponent estándar permite que la lógica permita el acceso no autenticado a las acciones / add y / token
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
        $tProvince = $this->paginate($this->TProvince);

        $this->set(compact('tProvince'));
    }

    /**
     * View method
     *
     * @param string|null $id T Province id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tProvince = $this->TProvince->get($id, [
            'contain' => []
        ]);

        $this->set('tProvince', $tProvince);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tProvince = $this->TProvince->newEntity();
        if ($this->request->is('post')) {
            $tProvince = $this->TProvince->patchEntity($tProvince, $this->request->getData());
            if ($this->TProvince->save($tProvince)) {
                $this->Flash->success(__('The t province has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t province could not be saved. Please, try again.'));
        }
        $this->set(compact('tProvince'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Province id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tProvince = $this->TProvince->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tProvince = $this->TProvince->patchEntity($tProvince, $this->request->getData());
            if ($this->TProvince->save($tProvince)) {
                $this->Flash->success(__('The t province has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t province could not be saved. Please, try again.'));
        }
        $this->set(compact('tProvince'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Province id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tProvince = $this->TProvince->get($id);
        if ($this->TProvince->delete($tProvince)) {
            $this->Flash->success(__('The t province has been deleted.'));
        } else {
            $this->Flash->error(__('The t province could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
}
