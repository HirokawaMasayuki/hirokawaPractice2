<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;//�Ɨ������e�[�u��������

/**
 * PriceProducts Controller
 *
 * @property \App\Model\Table\PriceProductsTable $PriceProducts
 *
 * @method \App\Model\Entity\PriceProduct[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PriceProductsController extends AppController
{
     public function initialize()
     {
        parent::initialize();
         $this->Staffs = TableRegistry::get('staffs');//staffs�e�[�u�����g��
         $this->Products = TableRegistry::get('products');//products�e�[�u�����g��
         $this->Customers = TableRegistry::get('customers');//customers�e�[�u�����g��
     }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Products', 'Customers']
        ];
        $priceProducts = $this->paginate($this->PriceProducts);

        $this->set('priceProducts', $this->PriceProducts->find('all', ['conditions' => ['delete_flag' => '0']]));//
        $this->set('entity',$this->PriceProducts->newEntity());//
//        $this->set(compact('priceProducts'));
    }

    public function login()//user�̂܂܂�ok
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
        $this->request->session()->destroy(); // �Z�b�V�����̔j��
        return $this->redirect($this->Auth->logout()); // ���O�A�E�g����
    }


    /**
     * View method
     *
     * @param string|null $id Price Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $priceProduct = $this->PriceProducts->get($id, [
            'contain' => ['Products', 'Customers']
        ]);

        $this->set('priceProduct', $priceProduct);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $priceProduct = $this->PriceProducts->newEntity();
        if ($this->request->is('post')) {
            $priceProduct = $this->PriceProducts->patchEntity($priceProduct, $this->request->getData());
            if ($this->PriceProducts->save($priceProduct)) {
                $this->Flash->success(__('The price product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The price product could not be saved. Please, try again.'));
        }
//        $products = $this->PriceProducts->Products->find('list', ['limit' => 200]);
//        $customers = $this->PriceProducts->Customers->find('list', ['limit' => 200]);
        $this->set(compact('priceProduct', 'products', 'customers'));

        $arrCustomers = $this->Customers->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrCustomer = array();//�z��̏�����
        foreach ($arrCustomers as $value) {//�ǉ�
            $arrCustomer[] = array($value->id=>$value->customer_id);//

        }
        $this->set('arrCustomer',$arrCustomer);//
        $this->set(compact('priceProduct', 'products', 'customers'));
        $this->set('_serialize', ['priceProduct']);//

        $arrProducts = $this->Products->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrProduct = array();//�z��̏�����
        foreach ($arrProducts as $value) {//�ǉ�
            $arrProduct[] = array($value->id=>$value->product_id);//

        }
        $this->set('arrProduct',$arrProduct);//
        $this->set(compact('priceProduct', 'products', 'customers'));
        $this->set('_serialize', ['priceProduct']);//


        $aaa = $this->Auth->user('staff_id');//user�̂܂�
        $priceProduct['created_staff'] = $aaa;//user��ύX


    }

    /**
     * Edit method
     *
     * @param string|null $id Price Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $priceProduct = $this->PriceProducts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $priceProduct = $this->PriceProducts->patchEntity($priceProduct, $this->request->getData());
            if ($this->PriceProducts->save($priceProduct)) {
                $this->Flash->success(__('The price product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The price product could not be saved. Please, try again.'));
        }
//        $products = $this->PriceProducts->Products->find('list', ['limit' => 200]);
//        $customers = $this->PriceProducts->Customers->find('list', ['limit' => 200]);
        $this->set(compact('priceProduct', 'products', 'customers'));

        $arrCustomers = $this->Customers->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrCustomer = array();//�z��̏�����
        foreach ($arrCustomers as $value) {//�ǉ�
            $arrCustomer[] = array($value->id=>$value->customer_id);//

        }
        $this->set('arrCustomer',$arrCustomer);//
        $this->set(compact('priceProduct', 'products', 'customers'));
        $this->set('_serialize', ['priceProduct']);//

        $arrProducts = $this->Products->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrProduct = array();//�z��̏�����
        foreach ($arrProducts as $value) {//�ǉ�
            $arrProduct[] = array($value->id=>$value->product_id);//

        }
        $this->set('arrProduct',$arrProduct);//
        $this->set(compact('priceProduct', 'products', 'customers'));
        $this->set('_serialize', ['priceProduct']);//


        $bbb = $this->Auth->user('staff_id');//user�̂܂�
        $priceProduct['updated_staff'] = $bbb;//user��ύX

    }

    /**
     * Delete method
     *
     * @param string|null $id Price Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $priceProduct = $this->PriceProducts->get($id);
        $priceProduct['delete_flag'] = '1';//

        $ccc = $this->Auth->user('staff_id');//
        $priceProduct['updated_staff'] = $ccc;//userhennkou

        if ($this->PriceProducts->save($priceProduct)) {//
            $this->Flash->success(__('The price product has been deleted.'));
        } else {
            $this->Flash->error(__('The price product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
