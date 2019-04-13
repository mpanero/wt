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
 * @method \App\Model\Entity\TType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
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
        $this->setDisplayField('INFO');
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
            ->allowEmpty('ID_TYPE', 'create');

        $validator
            ->maxLength('TYPE', 20)
            ->requirePresence('TYPE', 'create')
            ->notEmpty('TYPE');

        $validator
            ->maxLength('INFO', 100)
            ->requirePresence('INFO', 'create')
            ->notEmpty('INFO');

        $validator
            ->allowEmpty('INFO1');
        
        $validator
            ->allowEmpty('DATA_1');            

        $validator
            ->integer('ACTIVE')
            ->requirePresence('ACTIVE', 'create')
            ->notEmpty('ACTIVE');

        return $validator;
    }
}
