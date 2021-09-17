<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TPosition Model
 *
 * @method \App\Model\Entity\TPosition get($primaryKey, $options = [])
 * @method \App\Model\Entity\TPosition newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TPosition[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TPosition|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TPosition saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TPosition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TPosition[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TPosition findOrCreate($search, callable $callback = null, $options = [])
 */
class TPositionTable extends Table
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

        $this->setTable('t_position');
        $this->setDisplayField('ID_POSITION');
        $this->setPrimaryKey('ID_POSITION');
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
            ->integer('ID_POSITION')
            ->allowEmptyString('ID_POSITION', null, 'create');

        $validator
            ->scalar('POSITION')
            ->maxLength('POSITION', 10)
            ->requirePresence('POSITION', 'create')
            ->notEmptyString('POSITION')
            ->add('POSITION', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->date('DATE_POSITION')
            ->requirePresence('DATE_POSITION', 'create')
            ->notEmptyDate('DATE_POSITION');

        $validator
            ->integer('ID_TYPE_PRICE_INFO')
            ->requirePresence('ID_TYPE_PRICE_INFO', 'create')
            ->notEmptyString('ID_TYPE_PRICE_INFO');

        $validator
            ->integer('ACTIVE')
            ->notEmptyString('ACTIVE');

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
        $rules->add($rules->isUnique(['POSITION']));

        return $rules;
    }
}
