<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TMarket Model
 *
 * @method \App\Model\Entity\TMarket get($primaryKey, $options = [])
 * @method \App\Model\Entity\TMarket newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TMarket[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TMarket|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TMarket patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TMarket[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TMarket findOrCreate($search, callable $callback = null, $options = [])
 */
class TMarketTable extends Table
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

        $this->setTable('t_market');
        $this->setDisplayField('ID_MARKET');
        $this->setPrimaryKey('ID_MARKET');
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
            ->integer('ID_MARKET')
            ->allowEmpty('ID_MARKET', 'create');

        $validator
            ->scalar('MARKET_NAME')
            ->maxLength('MARKET_NAME', 100)
            ->allowEmpty('MARKET_NAME');

        $validator
            ->integer('ID_COUNTRY')
            ->requirePresence('ID_COUNTRY', 'create')
            ->notEmpty('ID_COUNTRY');

        $validator
            ->integer('ACTIVE')
            ->allowEmpty('ACTIVE');

        return $validator;
    }
}
