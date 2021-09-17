<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TSysParameters Model
 *
 * @method \App\Model\Entity\TSysParameter get($primaryKey, $options = [])
 * @method \App\Model\Entity\TSysParameter newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TSysParameter[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TSysParameter|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TSysParameter saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TSysParameter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TSysParameter[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TSysParameter findOrCreate($search, callable $callback = null, $options = [])
 */
class TSysParametersTable extends Table
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

        $this->setTable('t_sys_parameters');
        $this->setDisplayField('ID_PARAMETER');
        $this->setPrimaryKey('ID_PARAMETER');
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
            ->integer('ID_PARAMETER')
            ->allowEmptyString('ID_PARAMETER', null, 'create');

        $validator
            ->scalar('NAME_PARAMETER')
            ->maxLength('NAME_PARAMETER', 20)
            ->requirePresence('NAME_PARAMETER', 'create')
            ->notEmptyString('NAME_PARAMETER')
            ->add('NAME_PARAMETER', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('VALUE_PARAMETER')
            ->maxLength('VALUE_PARAMETER', 200)
            ->requirePresence('VALUE_PARAMETER', 'create')
            ->notEmptyString('VALUE_PARAMETER');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['NAME_PARAMETER']));

        return $rules;
    }
}
