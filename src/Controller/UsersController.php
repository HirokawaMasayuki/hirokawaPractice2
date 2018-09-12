<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;//独立したテーブルを扱う

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
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
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));

//          $aaa = $this->Auth->user();//Auth取出し実験

//            echo "<pre>";
//            print_r($aaa);
//            print_r($arrStaff);
//            echo "</pre>";


    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Staffs']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
//        $staffs = $this->Users->Staffs->find('list', ['limit' => 200]);
        $this->set(compact('user', 'staffs'));

        $arrStaffs = $this->Staffs->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrStaff = array();//配列の初期化
        foreach ($arrStaffs as $value) {//追加
//            $arrStaff[] = array($value->id=>$value->f_name);//
            $arrStaff[] = array($value->id=>$value->emp_code.':'.$value->f_name.$value->l_name);//

        }
        $this->set('arrStaff',$arrStaff);//
        $this->set(compact('user', 'staffs'));//userを変更
        $this->set('_serialize', ['user']);//userを変更

        $aaa = $this->Auth->user('staff_id');//
        $user['created_staff'] = $aaa;//userを変更
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
        $this->request->session()->destroy(); // セッションの破棄
        return $this->redirect($this->Auth->logout()); // ログアウト処理
    }
    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
//        $staffs = $this->Users->Staffs->find('list', ['limit' => 200]);
        $this->set(compact('user', 'staffs'));
        $bbb = $this->Auth->user('staff_id');//
        $user['updated_staff'] = $bbb;//

        $arrStaffs = $this->Staffs->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrStaff = array();//配列の初期化
        foreach ($arrStaffs as $value) {//追加
            $arrStaff[] = array($value->id=>$value->emp_code.':'.$value->f_name.$value->l_name);//
        }
        $this->set('arrStaff',$arrStaff);//
        $this->set(compact('user', 'staffs'));//
        $this->set('_serialize', ['user']);//

    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $user['delete_flag'] = '1';//
        $number = $this->request->supplier['delete_flg'];//
        if ($this->Users->save($user)) {//
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
