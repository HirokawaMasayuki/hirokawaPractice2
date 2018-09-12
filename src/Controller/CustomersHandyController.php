<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;//独立したテーブルを扱う

/**
 * CustomersHandy Controller
 *
 * @property \App\Model\Table\CustomersHandyTable $CustomersHandy
 *
 * @method \App\Model\Entity\CustomersHandy[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersHandyController extends AppController
{

     public function initialize()
     {
        parent::initialize();
         $this->Staffs = TableRegistry::get('staffs');//staffsテーブルを使う
         $this->Customers = TableRegistry::get('customers');//customersテーブルを使う
         $this->Delivers = TableRegistry::get('delivers');//deliversテーブルを使う
     }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers', 'Delivers']
        ];
        $customersHandy = $this->paginate($this->CustomersHandy);

        $this->set('customersHandy', $this->CustomersHandy->find('all', ['conditions' => ['flag' => '0']]));//
        $this->set('entity',$this->CustomersHandy->newEntity());//
//        $this->set(compact('customersHandy'));
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
     * @param string|null $id Customers Handy id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customersHandy = $this->CustomersHandy->get($id, [
            'contain' => ['Customers', 'Delivers']
        ]);

        $this->set('customersHandy', $customersHandy);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customersHandy = $this->CustomersHandy->newEntity();
        if ($this->request->is('post')) {
            $customersHandy = $this->CustomersHandy->patchEntity($customersHandy, $this->request->getData());
            if ($this->CustomersHandy->save($customersHandy)) {
                $this->Flash->success(__('The customers handy has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customers handy could not be saved. Please, try again.'));
        }
//        $customers = $this->CustomersHandy->Customers->find('list', ['limit' => 200]);
//        $Delivers = $this->CustomersHandy->Delivers->find('list', ['limit' => 200]);
        $this->set(compact('customersHandy', 'customers', 'delivers'));

        $arrCustomers = $this->Customers->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrCustomer = array();//配列の初期化
        foreach ($arrCustomers as $value) {//追加
            $arrCustomer[] = array($value->id=>$value->customer_code.':'.$value->name);//

        }
        $this->set('arrCustomer',$arrCustomer);//
        $this->set(compact('customersHandy', 'customers', 'delivers'));
        $this->set('_serialize', ['customersHandy']);//

        $arrDelivers = $this->Delivers->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrDeliver = array();//配列の初期化
        foreach ($arrDelivers as $value) {//追加
            $arrDeliver[] = array($value->id=>$value->place_deliver_id);//

        }
        $this->set('arrDeliver',$arrDeliver);//
        $this->set(compact('customersHandy', 'customers', 'delivers'));
        $this->set('_serialize', ['customersHandy']);//


        $aaa = $this->Auth->user('staff_id');//userのまま
        $customersHandy['created_staff'] = $aaa;//userを変更

    }

    /**
     * Edit method
     *
     * @param string|null $id Customers Handy id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customersHandy = $this->CustomersHandy->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customersHandy = $this->CustomersHandy->patchEntity($customersHandy, $this->request->getData());
            if ($this->CustomersHandy->save($customersHandy)) {
                $this->Flash->success(__('The customers handy has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customers handy could not be saved. Please, try again.'));
        }
//        $customers = $this->CustomersHandy->Customers->find('list', ['limit' => 200]);
//        $Delivers = $this->CustomersHandy->Delivers->find('list', ['limit' => 200]);
        $this->set(compact('customersHandy', 'customers', 'delivers'));

        $arrCustomers = $this->Customers->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrCustomer = array();//配列の初期化
        foreach ($arrCustomers as $value) {//追加
            $arrCustomer[] = array($value->id=>$value->customer_code.':'.$value->name);//

        }
        $this->set('arrCustomer',$arrCustomer);//
        $this->set(compact('customersHandy', 'customers', 'delivers'));
        $this->set('_serialize', ['customersHandy']);//

        $arrDelivers = $this->Delivers->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrDeliver = array();//配列の初期化
        foreach ($arrDelivers as $value) {//追加
            $arrDeliver[] = array($value->id=>$value->place_deliver_id);//

        }
        $this->set('arrDeliver',$arrDeliver);//
        $this->set(compact('customersHandy', 'customers', 'delivers'));
        $this->set('_serialize', ['customersHandy']);//


        $bbb = $this->Auth->user('staff_id');//userのまま
        $customersHandy['updated_staff'] = $bbb;//userを変更

    }

    /**
     * Delete method
     *
     * @param string|null $id Customers Handy id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customersHandy = $this->CustomersHandy->get($id);
        $customersHandy['flag'] = '1';//

        $ccc = $this->Auth->user('staff_id');//
        $customersHandy['updated_staff'] = $ccc;//userhennkou

        if ($this->CustomersHandy->save($customersHandy)) {//
            $this->Flash->success(__('The customers handy has been deleted.'));
        } else {
            $this->Flash->error(__('The customers handy could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
