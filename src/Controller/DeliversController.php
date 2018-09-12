<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;//�Ɨ������e�[�u��������

/**
 * Delivers Controller
 *
 * @property \App\Model\Table\DeliversTable $Delivers
 *
 * @method \App\Model\Entity\Deliver[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DeliversController extends AppController
{
     public function initialize()
     {
        parent::initialize();
         $this->Staffs = TableRegistry::get('staffs');//Staffs,staffs�e�[�u�����g��
         $this->Customers = TableRegistry::get('customers');//Customers,customers�e�[�u�����g��
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
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers', 'Staffs']
        ];
        $delivers = $this->paginate($this->Delivers);

        $this->set('delivers', $this->Delivers->find('all', ['conditions' => ['delete_flag' => '0']]));//
        $this->set('entity',$this->Delivers->newEntity());//
//        $this->set(compact('delivers'));
    }

    /**
     * View method
     *
     * @param string|null $id Deliver id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $deliver = $this->Delivers->get($id, [
            'contain' => ['Customers', 'Staffs']
        ]);

        $this->set('deliver', $deliver);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $deliver = $this->Delivers->newEntity();
        if ($this->request->is('post')) {
            $deliver = $this->Delivers->patchEntity($deliver, $this->request->getData());
            if ($this->Delivers->save($deliver)) {
                $this->Flash->success(__('The deliver has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The deliver could not be saved. Please, try again.'));

        }
//        $customers = $this->Delivers->Customers->find('list', ['limit' => 200]);
//        $placeDelivers = $this->Delivers->PlaceDelivers->find('list', ['limit' => 200]);
//        $this->set(compact('deliver', 'customers', 'placeDelivers'));

        $this->set(compact('deliver', 'customers', 'staffs'));

        $arrCustomers = $this->Customers->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrCustomer = array();//�z��̏�����
        foreach ($arrCustomers as $value) {//�ǉ�
            $arrCustomer[] = array($value->id=>$value->customer_code.':'.$value->name);//

        }
        $this->set('arrCustomer',$arrCustomer);//
        $this->set(compact('deliver', 'customer', 'staffs'));//
        $this->set('_serialize', ['deliver']);//

        $aaa = $this->Auth->user('staff_id');//user�̂܂�
        $deliver['created_staff'] = $aaa;//user��ύX

    }

    /**
     * Edit method
     *
     * @param string|null $id Deliver id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $deliver = $this->Delivers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $deliver = $this->Delivers->patchEntity($deliver, $this->request->getData());
            if ($this->Delivers->save($deliver)) {
                $this->Flash->success(__('The deliver has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The deliver could not be saved. Please, try again.'));
        }
//        $customers = $this->Delivers->Customers->find('list', ['limit' => 200]);
//        $placeDelivers = $this->Delivers->PlaceDelivers->find('list', ['limit' => 200]);
//        $this->set(compact('deliver', 'customers', 'placeDelivers'));

        $this->set(compact('deliver', 'customers', 'staffs'));
        $bbb = $this->Auth->user('staff_id');//
        $deliver['updated_staff'] = $bbb;//userhennkou

        $arrCustomers = $this->Customers->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrCustomer = array();//�z��̏�����
        foreach ($arrCustomers as $value) {//�ǉ�
            $arrCustomer[] = array($value->id=>$value->customer_code.':'.$value->name);//
        }
        $this->set('arrCustomer',$arrCustomer);//
        $this->set(compact('deliver', 'customer', 'staffs'));//
        $this->set('_serialize', ['deliver']);//

    }

    /**
     * Delete method
     *
     * @param string|null $id Deliver id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $deliver = $this->Delivers->get($id);
        $deliver['delete_flag'] = '1';//

        $ccc = $this->Auth->user('staff_id');//
        $deliver['updated_staff'] = $ccc;//userhennkou

        if ($this->Delivers->save($deliver)) {//
            $this->Flash->success(__('The deliver has been deleted.'));
        } else {
            $this->Flash->error(__('The deliver could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
