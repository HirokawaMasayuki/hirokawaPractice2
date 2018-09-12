<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
     public function initialize()
     {
        parent::initialize();
         $this->Staffs = TableRegistry::get('staffs');
         $this->Customers = TableRegistry::get('customers');
         $this->Materials = TableRegistry::get('materials');
     }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Staffs', 'Customers', 'Materials']
        ];
        $products = $this->paginate($this->Products);

        $this->set('products', $this->Products->find('all', ['conditions' => ['delete_flag' => '0']]));
        $this->set('entity',$this->Products->newEntity());
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
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Staffs', 'Customers', 'Materials']
        ]);

        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product', 'staffs', 'customers', 'materials'));

        $arrCustomers = $this->Customers->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);
        $arrCustomer = array();
        foreach ($arrCustomers as $value) {
            $arrCustomer[] = array($value->id=>$value->customer_code.':'.$value->name);

        }
        $this->set('arrCustomer',$arrCustomer);
        $this->set(compact('product', 'staffs', 'customers', 'materials'));
        $this->set('_serialize', ['product']);

        $arrMaterials = $this->Materials->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);
        $arrMaterial = array();
        foreach ($arrMaterials as $value) {
            $arrMaterial[] = array($value->id=>$value->grade.':'.$value->color);

        }
        $this->set('arrMaterial',$arrMaterial);
        $this->set(compact('product', 'staffs', 'customers', 'materials'));
        $this->set('_serialize', ['product']);

        $aaa = $this->Auth->user('staff_id');
        $product['created_staff'] = $aaa;

    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product', 'staffs', 'customers', 'materials'));

        $arrCustomers = $this->Customers->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);
        $arrCustomer = array();
        foreach ($arrCustomers as $value) {
            $arrCustomer[] = array($value->id=>$value->customer_code.':'.$value->name);

        }
        $this->set('arrCustomer',$arrCustomer);
        $this->set(compact('product', 'staffs', 'customers', 'materials'));
        $this->set('_serialize', ['product']);

        $arrMaterials = $this->Materials->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);
        $arrMaterial = array();
        foreach ($arrMaterials as $value) {
            $arrMaterial[] = array($value->id=>$value->material_id);

        }
        $this->set('arrMaterial',$arrMaterial);
        $this->set(compact('product', 'staffs', 'customers', 'materials'));
        $this->set('_serialize', ['product']);

        $bbb = $this->Auth->user('staff_id');
        $product['updated_staff'] = $bbb;

    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        $product['delete_flag'] = '1';

        $ccc = $this->Auth->user('staff_id');
        $product['updated_staff'] = $ccc;

        if ($this->Products->save($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
