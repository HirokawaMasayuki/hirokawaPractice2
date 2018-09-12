<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;//独立したテーブルを扱う

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 *
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{

     public function initialize()
     {
        parent::initialize();
         $this->Staffs = TableRegistry::get('staffs');//staffsテーブルを使う
     }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Staffs']
        ];
        $customers = $this->paginate($this->Customers);

        $this->set('customers', $this->Customers->find('all', ['conditions' => ['delete_flag' => '0']]));//
        $this->set('entity',$this->Customers->newEntity());//
//        $this->set(compact('customers'));

          $aa = $this->Auth->user('staff_id');//Auth取出し実験
/*
            echo "<pre>";
            print_r($aa);
//            print_r($arrStaff);
            echo "</pre>";
*/

    }

    public function login()//userのままでok
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
        $this->request->session()->destroy(); // セッションの破棄
        return $this->redirect($this->Auth->logout()); // ログアウト処理
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => ['Staffs']
        ]);

        $this->set('customer', $customer);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customers->newEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $staffs = $this->Customers->Staffs->find('list', ['limit' => 200]);
        $this->set(compact('customer', 'staffs'));

        $arrStaffs = $this->Staffs->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrStaff = array();//配列の初期化
        foreach ($arrStaffs as $value) {//追加
//            $arrStaff[] = array($value->id=>$value->f_name);//
            $arrStaff[] = array($value->id=>$value->emp_code.':'.$value->f_name.$value->l_name);//

        }
        $this->set('arrStaff',$arrStaff);//
        $this->set(compact('customer', 'staffs'));//
        $this->set('_serialize', ['customer']);//

        $aaa = $this->Auth->user('staff_id');//userのまま
        $customer['created_staff'] = $aaa;//userを変更

    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $staffs = $this->Customers->Staffs->find('list', ['limit' => 200]);
        $this->set(compact('customer', 'staffs'));
        $bbb = $this->Auth->user('staff_id');//
        $customer['updated_staff'] = $bbb;//

    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        $customer['delete_flag'] = '1';//

        $ccc = $this->Auth->user('staff_id');//
        $customer['updated_staff'] = $ccc;//userhennkou

        if ($this->Customers->save($customer)) {//
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
