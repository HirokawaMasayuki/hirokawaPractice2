<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;//独立したテーブルを扱う

/**
 * PriceMaterials Controller
 *
 * @property \App\Model\Table\PriceMaterialsTable $PriceMaterials
 *
 * @method \App\Model\Entity\PriceMaterial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PriceMaterialsController extends AppController
{
     public function initialize()
     {
        parent::initialize();
         $this->Staffs = TableRegistry::get('staffs');//staffsテーブルを使う
         $this->Materials = TableRegistry::get('materials');//materialsテーブルを使う
         $this->Suppliers = TableRegistry::get('suppliers');//suppliersテーブルを使う
     }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Materials', 'Suppliers']
        ];
        $priceMaterials = $this->paginate($this->PriceMaterials);

        $this->set('priceMaterials', $this->PriceMaterials->find('all', ['conditions' => ['delete_flag' => '0']]));//
        $this->set('entity',$this->PriceMaterials->newEntity());//
//        $this->set(compact('priceMaterials'));
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
     * @param string|null $id Price Material id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $priceMaterial = $this->PriceMaterials->get($id, [
            'contain' => ['Materials', 'Suppliers']
        ]);

        $this->set('priceMaterial', $priceMaterial);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $priceMaterial = $this->PriceMaterials->newEntity();
        if ($this->request->is('post')) {
            $priceMaterial = $this->PriceMaterials->patchEntity($priceMaterial, $this->request->getData());
            if ($this->PriceMaterials->save($priceMaterial)) {
                $this->Flash->success(__('The price material has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The price material could not be saved. Please, try again.'));
        }
//        $materials = $this->PriceMaterials->Materials->find('list', ['limit' => 200]);
//        $suppliers = $this->PriceMaterials->Suppliers->find('list', ['limit' => 200]);
        $this->set(compact('priceMaterial', 'materials', 'suppliers'));
        $arrMaterials = $this->Materials->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrMaterial = array();//配列の初期化
        foreach ($arrMaterials as $value) {//追加
            $arrMaterial[] = array($value->id=>$value->material_id);//

        }
        $this->set('arrMaterial',$arrMaterial);//
        $this->set(compact('priceMaterial', 'materials', 'suppliers'));
        $this->set('_serialize', ['priceMaterial']);//

        $arrSuppliers = $this->Suppliers->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrSupplier = array();//配列の初期化
        foreach ($arrSuppliers as $value) {//追加
            $arrSupplier[] = array($value->id=>$value->supplier_id);//

        }
        $this->set('arrSupplier',$arrSupplier);//
        $this->set(compact('priceMaterial', 'materials', 'suppliers'));
        $this->set('_serialize', ['priceMaterial']);//


        $aaa = $this->Auth->user('staff_id');//userのまま
        $priceMaterial['created_staff'] = $aaa;//userを変更

    }

    /**
     * Edit method
     *
     * @param string|null $id Price Material id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $priceMaterial = $this->PriceMaterials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $priceMaterial = $this->PriceMaterials->patchEntity($priceMaterial, $this->request->getData());
            if ($this->PriceMaterials->save($priceMaterial)) {
                $this->Flash->success(__('The price material has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The price material could not be saved. Please, try again.'));
        }
//        $materials = $this->PriceMaterials->Materials->find('list', ['limit' => 200]);
//        $suppliers = $this->PriceMaterials->Suppliers->find('list', ['limit' => 200]);
        $this->set(compact('priceMaterial', 'materials', 'suppliers'));
        $arrMaterials = $this->Materials->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrMaterial = array();//配列の初期化
        foreach ($arrMaterials as $value) {//追加
            $arrMaterial[] = array($value->id=>$value->material_id);//

        }
        $this->set('arrMaterial',$arrMaterial);//
        $this->set(compact('priceMaterial', 'materials', 'suppliers'));
        $this->set('_serialize', ['priceMaterial']);//

        $arrSuppliers = $this->Suppliers->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrSupplier = array();//配列の初期化
        foreach ($arrSuppliers as $value) {//追加
            $arrSupplier[] = array($value->id=>$value->supplier_id);//

        }
        $this->set('arrSupplier',$arrSupplier);//
        $this->set(compact('priceMaterial', 'materials', 'suppliers'));
        $this->set('_serialize', ['priceMaterial']);//


        $bbb = $this->Auth->user('staff_id');//userのまま
        $priceMaterial['updated_staff'] = $bbb;//userを変更

    }

    /**
     * Delete method
     *
     * @param string|null $id Price Material id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $priceMaterial = $this->PriceMaterials->get($id);
        $priceMaterial['delete_flag'] = '1';//

        $ccc = $this->Auth->user('staff_id');//
        $priceMaterial['updated_staff'] = $ccc;//userhennkou

        if ($this->PriceMaterials->save($priceMaterial)) {//
            $this->Flash->success(__('The price material has been deleted.'));
        } else {
            $this->Flash->error(__('The price material could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
