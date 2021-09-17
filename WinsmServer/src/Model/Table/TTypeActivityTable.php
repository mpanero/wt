<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TTypeActivity Model
 *
 * @method \App\Model\Entity\TTypeActivity get($primaryKey, $options = [])
 * @method \App\Model\Entity\TTypeActivity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TTypeActivity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TTypeActivity|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TTypeActivity saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TTypeActivity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TTypeActivity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TTypeActivity findOrCreate($search, callable $callback = null, $options = [])
 */
class TTypeActivityTable extends Table
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

        $this->setTable('t_type_activity');
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
            ->requirePresence('ID_ACTIVITY', 'create')
            ->notEmptyString('ID_ACTIVITY');

        $validator
            ->scalar('ACTIVITY_NAME')
            ->maxLength('ACTIVITY_NAME', 50)
            ->requirePresence('ACTIVITY_NAME', 'create')
            ->notEmptyString('ACTIVITY_NAME');

        $validator
            ->scalar('ACTIVITY_NAME_EN')
            ->maxLength('ACTIVITY_NAME_EN', 50)
            ->allowEmptyString('ACTIVITY_NAME_EN');

        $validator
            ->integer('ACTIVITY_NAME_PO')
            ->allowEmptyString('ACTIVITY_NAME_PO');

        return $validator;
    }
}
