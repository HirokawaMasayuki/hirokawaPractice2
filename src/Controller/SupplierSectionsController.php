<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * SupplierSections Controller
 *
 * @property \App\Model\Table\SupplierSectionsTable $SupplierSections
 *
 * @method \App\Model\Entity\SupplierSection[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SupplierSectionsController extends AppController
{
     public function initialize()
     {
        parent::initialize();
         $this->Staffs = TableRegistry::get('staffs');
     }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $supplierSections = $this->paginate($this->SupplierSections);

        $this->set('supplierSections', $this->SupplierSections->find('all', ['conditions' => ['delete_flag' => '0']]));
        $this->set('entity',$this->SupplierSections->newEntity());
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        $this->request->session()->destroy(); 
        return $this->redirect($this->Auth->logout()); 
    }

    /**
     * View method
     *
     * @param string|null $id Supplier Section id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $supplierSection = $this->SupplierSections->get($id, [
            'contain' => []
        ]);

        $this->set('supplierSection', $supplierSection);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $supplierSection = $this->SupplierSections->newEntity();
        if ($this->request->is('post')) {
            $supplierSection = $this->SupplierSections->patchEntity($supplierSection, $this->request->getData());
            if ($this->SupplierSections->save($supplierSection)) {
                $this->Flash->success(__('The supplier section has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The supplier section could not be saved. Please, try again.'));
        }
        $this->set(compact('supplierSection'));

        $aaa = $this->Auth->user('staff_id');
        $supplierSection['created_staff'] = $aaa;

    }

    /**
     * Edit method
     *
     * @param string|null $id Supplier Section id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $supplierSection = $this->SupplierSections->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $supplierSection = $this->SupplierSections->patchEntity($supplierSection, $this->request->getData());
            if ($this->SupplierSections->save($supplierSection)) {
                $this->Flash->success(__('The supplier section has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The supplier section could not be saved. Please, try again.'));
        }
        $this->set(compact('supplierSection'));

        $bbb = $this->Auth->user('staff_id');
        $supplierSection['updated_staff'] = $bbb;

    }

    /**
     * Delete method
     *
     * @param string|null $id Supplier Section id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $supplierSection = $this->SupplierSections->get($id);
        $supplierSection['delete_flag'] = '1';

        $ccc = $this->Auth->user('staff_id');
        $supplierSection['updated_staff'] = $ccc;

        if ($this->SupplierSections->save($supplierSection)) {
            $this->Flash->success(__('The supplier section has been deleted.'));
        } else {
            $this->Flash->error(__('The supplier section could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
