<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TCountry Model
 *
 * @method \App\Model\Entity\TCountry get($primaryKey, $options = [])
 * @method \App\Model\Entity\TCountry newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TCountry[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TCountry|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TCountry saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TCountry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TCountry[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TCountry findOrCreate($search, callable $callback = null, $options = [])
 */
class TCountryTable extends Table
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

        $this->setTable('t_country');
        $this->setDisplayField('ID_COUNTRY');
        $this->setPrimaryKey('ID_COUNTRY');
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
            ->integer('ID_COUNTRY')
            ->allowEmptyString('ID_COUNTRY', null, 'create');

        $validator
            ->scalar('COUNTRY_NAME')
            ->maxLength('COUNTRY_NAME', 45)
            ->allowEmptyString('COUNTRY_NAME');

        $validator
            ->integer('ACTIVE')
            ->requirePresence('ACTIVE', 'create')
            ->notEmptyString('ACTIVE');

        return $validator;
    }
}
