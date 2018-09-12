<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;//�Ɨ������e�[�u��������

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
         $this->Staffs = TableRegistry::get('staffs');//staffs�e�[�u�����g��
         $this->Materials = TableRegistry::get('materials');//materials�e�[�u�����g��
         $this->Suppliers = TableRegistry::get('suppliers');//suppliers�e�[�u�����g��
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
        $arrMaterial = array();//�z��̏�����
        foreach ($arrMaterials as $value) {//�ǉ�
            $arrMaterial[] = array($value->id=>$value->material_id);//

        }
        $this->set('arrMaterial',$arrMaterial);//
        $this->set(compact('priceMaterial', 'materials', 'suppliers'));
        $this->set('_serialize', ['priceMaterial']);//

        $arrSuppliers = $this->Suppliers->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrSupplier = array();//�z��̏�����
        foreach ($arrSuppliers as $value) {//�ǉ�
            $arrSupplier[] = array($value->id=>$value->supplier_id);//

        }
        $this->set('arrSupplier',$arrSupplier);//
        $this->set(compact('priceMaterial', 'materials', 'suppliers'));
        $this->set('_serialize', ['priceMaterial']);//


        $aaa = $this->Auth->user('staff_id');//user�̂܂�
        $priceMaterial['created_staff'] = $aaa;//user��ύX

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
        $arrMaterial = array();//�z��̏�����
        foreach ($arrMaterials as $value) {//�ǉ�
            $arrMaterial[] = array($value->id=>$value->material_id);//

        }
        $this->set('arrMaterial',$arrMaterial);//
        $this->set(compact('priceMaterial', 'materials', 'suppliers'));
        $this->set('_serialize', ['priceMaterial']);//

        $arrSuppliers = $this->Suppliers->find('all', ['conditions' => ['delete_flag' => '0']])->order(['id' => 'ASC']);//
        $arrSupplier = array();//�z��̏�����
        foreach ($arrSuppliers as $value) {//�ǉ�
            $arrSupplier[] = array($value->id=>$value->supplier_id);//

        }
        $this->set('arrSupplier',$arrSupplier);//
        $this->set(compact('priceMaterial', 'materials', 'suppliers'));
        $this->set('_serialize', ['priceMaterial']);//


        $bbb = $this->Auth->user('staff_id');//user�̂܂�
        $priceMaterial['updated_staff'] = $bbb;//user��ύX

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
