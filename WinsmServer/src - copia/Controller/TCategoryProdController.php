<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TCategoryProd Controller
 *
 * @property \App\Model\Table\TCategoryProdTable $TCategoryProd
 *
 * @method \App\Model\Entity\TCategoryProd[] paginate($object = null, array $settings = [])
 */
class TCategoryProdController extends AppController
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
        $tCategoryProd = $this->paginate($this->TCategoryProd);

        $this->set(compact('tCategoryProd'));
    }

    /**
     * View method
     *
     * @param string|null $id T Category Prod id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tCategoryProd = $this->TCategoryProd->get($id, [
            'contain' => []
        ]);

        $this->set('tCategoryProd', $tCategoryProd);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tCategoryProd = $this->TCategoryProd->newEntity();
        if ($this->request->is('post')) {
            $tCategoryProd = $this->TCategoryProd->patchEntity($tCategoryProd, $this->request->getData());
            if ($this->TCategoryProd->save($tCategoryProd)) {
                $this->Flash->success(__('The t category prod has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t category prod could not be saved. Please, try again.'));
        }
        $this->set(compact('tCategoryProd'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Category Prod id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tCategoryProd = $this->TCategoryProd->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tCategoryProd = $this->TCategoryProd->patchEntity($tCategoryProd, $this->request->getData());
            if ($this->TCategoryProd->save($tCategoryProd)) {
                $this->Flash->success(__('The t category prod has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t category prod could not be saved. Please, try again.'));
        }
        $this->set(compact('tCategoryProd'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Category Prod id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tCategoryProd = $this->TCategoryProd->get($id);
        if ($this->TCategoryProd->delete($tCategoryProd)) {
            $this->Flash->success(__('The t category prod has been deleted.'));
        } else {
            $this->Flash->error(__('The t category prod could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
