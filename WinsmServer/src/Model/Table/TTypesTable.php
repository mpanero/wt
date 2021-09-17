<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TTypes Model
 *
 * @method \App\Model\Entity\TType get($primaryKey, $options = [])
 * @method \App\Model\Entity\TType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TType|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TType findOrCreate($search, callable $callback = null, $options = [])
 */
class TTypesTable extends Table
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

        $this->setTable('t_types');
        $this->setDisplayField('ID_TYPE');
        $this->setPrimaryKey('ID_TYPE');
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
            ->allowEmptyString('ID_TYPE', null, 'create');

        $validator
            ->scalar('TYPE')
            ->maxLength('TYPE', 20)
            ->requirePresence('TYPE', 'create')
            ->notEmptyString('TYPE');

        $validator
            ->scalar('INFO')
            ->maxLength('INFO', 100)
            ->requirePresence('INFO', 'create')
            ->notEmptyString('INFO');

        $validator
            ->scalar('INFO1')
            ->maxLength('INFO1', 200)
            ->allowEmptyString('INFO1');

        $validator
            ->integer('ACTIVE')
            ->notEmptyString('ACTIVE');

        $validator
            ->scalar('DATA_1')
            ->maxLength('DATA_1', 50)
            ->requirePresence('DATA_1', 'create')
            ->notEmptyString('DATA_1');

        $validator
            ->integer('ORDER_INFO')
            ->requirePresence('ORDER_INFO', 'create')
            ->notEmptyString('ORDER_INFO');

        return $validator;
    }
}
