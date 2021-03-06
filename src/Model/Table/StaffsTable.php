<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Staffs Model
 *
 * @method \App\Model\Entity\Staff get($primaryKey, $options = [])
 * @method \App\Model\Entity\Staff newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Staff[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Staff|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Staff|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Staff patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Staff[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Staff findOrCreate($search, callable $callback = null, $options = [])
 */
class StaffsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('staffs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp', [//下のcreated_atとかを消す
          'events' => [
            'Model.beforeSave' => [
              'created_at' => 'new',
              'updated_at' => 'existing'
            ]
          ]
        ]);


    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('emp_code')
            ->maxLength('emp_code', 10)
            ->requirePresence('emp_code', 'create')
            ->notEmpty('emp_code');

        $validator
            ->scalar('f_name')
            ->maxLength('f_name', 255)
            ->requirePresence('f_name', 'create')
            ->notEmpty('f_name');

        $validator
            ->scalar('l_name')
            ->maxLength('l_name', 255)
            ->requirePresence('l_name', 'create')
            ->notEmpty('l_name');

        $validator
            ->scalar('sex')
            ->maxLength('sex', 255)
            ->requirePresence('sex', 'create')
            ->notEmpty('sex');

        $validator
            ->date('birth')
            ->requirePresence('birth', 'create')
            ->notEmpty('birth');

        $validator
            ->scalar('mail')
            ->maxLength('mail', 255)
            ->requirePresence('mail', 'create')
            ->notEmpty('mail');

        $validator
            ->scalar('tel')
            ->maxLength('tel', 255)
            ->requirePresence('tel', 'create')
            ->notEmpty('tel');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->scalar('level')
            ->maxLength('level', 255)
            ->requirePresence('level', 'create')
            ->notEmpty('level');

        $validator
            ->integer('delete_flag')
            ->requirePresence('delete_flag', 'create')
            ->notEmpty('delete_flag');
/*
        $validator
            ->dateTime('created_at')
            ->requirePresence('created_at', 'create')
            ->notEmpty('created_at');
*/
        $validator
            ->uuid('created_staff')
            ->allowEmpty('created_staff');
/*
        $validator
            ->dateTime('updated_at')
            ->allowEmpty('updated_at');
*/
        $validator
            ->uuid('updated_staff')
            ->allowEmpty('updated_staff');

        return $validator;
    }
}
