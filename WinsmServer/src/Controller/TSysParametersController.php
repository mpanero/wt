<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TSysParameters Controller
 *
 * @property \App\Model\Table\TSysParametersTable $TSysParameters
 *
 * @method \App\Model\Entity\TSysParameter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TSysParametersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $tSysParameters = $this->paginate($this->TSysParameters);

        $this->set(compact('tSysParameters'));
    }

    /**
     * View method
     *
     * @param string|null $id T Sys Parameter id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tSysParameter = $this->TSysParameters->get($id, [
            'contain' => []
        ]);

        $this->set('tSysParameter', $tSysParameter);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tSysParameter = $this->TSysParameters->newEntity();
        if ($this->request->is('post')) {
            $tSysParameter = $this->TSysParameters->patchEntity($tSysParameter, $this->request->getData());
            if ($this->TSysParameters->save($tSysParameter)) {
                $this->Flash->success(__('The t sys parameter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t sys parameter could not be saved. Please, try again.'));
        }
        $this->set(compact('tSysParameter'));
    }

    /**
     * Edit method
     *
     * @param string|null $id T Sys Parameter id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tSysParameter = $this->TSysParameters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tSysParameter = $this->TSysParameters->patchEntity($tSysParameter, $this->request->getData());
            if ($this->TSysParameters->save($tSysParameter)) {
                $this->Flash->success(__('The t sys parameter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The t sys parameter could not be saved. Please, try again.'));
        }
        $this->set(compact('tSysParameter'));
    }

    /**
     * Delete method
     *
     * @param string|null $id T Sys Parameter id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tSysParameter = $this->TSysParameters->get($id);
        if ($this->TSysParameters->delete($tSysParameter)) {
            $this->Flash->success(__('The t sys parameter has been deleted.'));
        } else {
            $this->Flash->error(__('The t sys parameter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
