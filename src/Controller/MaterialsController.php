<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;//独立したテーブルを扱う

/**
 * Materials Controller
 *
 * @property \App\Model\Table\MaterialsTable $Materials
 *
 * @method \App\Model\Entity\Material[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MaterialsController extends AppController
{

     public function initialize()
     {
        parent::initialize();
         $this->Staffs = TableRegistry::get('staffs');//staffsテーブルを使う
         $this->Suppliers = TableRegistry::get('suppliers');//suppliersテーブルを使う
         $this->MaterialTypes = TableRegistry::get('materialTypes');//materialTypesテーブルを使う
     }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['MaterialTypes', 'Suppliers']
        ];
        $materials = $this->paginate($this->Materials);

        $this->set('materials', $this->Materials->find('all', ['conditions' => ['delete_flag' => '0']]));//
        $this->set('entity',$this->Materials->newEntity());//
//        $this->set(compact('materials'));
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
     * @param string|null $id Material id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $material = $this->Materials->get($id, [
            'contain' => ['MaterialTypes', 'Suppliers']
        ]);

        $this->set('material', $material);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $material = $this->Materials->newEntity();
        if ($this->request->is('post')) {
            $material = $this->Materials->patchEntity($material, $this->request->getData());
            if ($this->Materials->save($material)) {
                $this->Flash->success(__('The material has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The material could not be saved. Please, try again.'));
        }
//        $materialTypes = $this->Materials->MaterialTypes->find('list', ['limit' => 200]);
//        $suppliers = $this->Materials->Suppliers->find('list', ['limit' => 200]);
        $this->set(compact('material', 'materialTypes', 'suppliers'));

        $arrSuppliers = $this->Suppliers->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrSupplier = array();//配列の初期化
        foreach ($arrSuppliers as $value) {//追加
            $arrSupplier[] = array($value->id=>$value->supplier_id.':'.$value->name);//

        }
        $this->set('arrSupplier',$arrSupplier);//
        $this->set(compact('material', 'materialTypes', 'suppliers'));
        $this->set('_serialize', ['material']);//

        $arrMaterialTypes = $this->MaterialTypes->find('all')->order(['id' => 'ASC']);//
        $arrMaterialType = array();//配列の初期化
        foreach ($arrMaterialTypes as $value) {//追加
            $arrMaterialType[] = array($value->id=>$value->material_type_id.':'.$value->name);//

        }
        $this->set('arrMaterialType',$arrMaterialType);//
        $this->set(compact('material', 'materialTypes', 'suppliers'));
        $this->set('_serialize', ['material']);//


        $aaa = $this->Auth->user('staff_id');//userのまま
        $material['created_staff'] = $aaa;//userを変更

    }

    /**
     * Edit method
     *
     * @param string|null $id Material id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $material = $this->Materials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $material = $this->Materials->patchEntity($material, $this->request->getData());
            if ($this->Materials->save($material)) {
                $this->Flash->success(__('The material has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The material could not be saved. Please, try again.'));
        }
//        $materialTypes = $this->Materials->MaterialTypes->find('list', ['limit' => 200]);
//        $suppliers = $this->Materials->Suppliers->find('list', ['limit' => 200]);
        $this->set(compact('material', 'materialTypes', 'suppliers'));

        $arrSuppliers = $this->Suppliers->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrSupplier = array();//配列の初期化
        foreach ($arrSuppliers as $value) {//追加
            $arrSupplier[] = array($value->id=>$value->supplier_id.':'.$value->name);//

        }
        $this->set('arrSupplier',$arrSupplier);//
        $this->set(compact('material', 'materialTypes', 'suppliers'));
        $this->set('_serialize', ['material']);//

        $arrMaterialTypes = $this->MaterialTypes->find('all')->order(['id' => 'ASC']);//
        $arrMaterialType = array();//配列の初期化
        foreach ($arrMaterialTypes as $value) {//追加
            $arrMaterialType[] = array($value->id=>$value->material_type_id.':'.$value->name);//

        }
        $this->set('arrMaterialType',$arrMaterialType);//
        $this->set(compact('material', 'materialTypes', 'suppliers'));
        $this->set('_serialize', ['material']);//


        $bbb = $this->Auth->user('staff_id');//userのまま
        $material['updated_staff'] = $bbb;//userを変更

    }

    /**
     * Delete method
     *
     * @param string|null $id Material id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $material = $this->Materials->get($id);
        $material['delete_flag'] = '1';//

        $ccc = $this->Auth->user('staff_id');//
        $material['updated_staff'] = $ccc;//userhennkou

        if ($this->Materials->save($material)) {//
            $this->Flash->success(__('The material has been deleted.'));
        } else {
            $this->Flash->error(__('The material could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
