<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TTypePricePlaces Model
 *
 * @method \App\Model\Entity\TTypePricePlace get($primaryKey, $options = [])
 * @method \App\Model\Entity\TTypePricePlace newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TTypePricePlace[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TTypePricePlace|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TTypePricePlace saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TTypePricePlace patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TTypePricePlace[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TTypePricePlace findOrCreate($search, callable $callback = null, $options = [])
 */
class TTypePricePlacesTable extends Table
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

        $this->setTable('t_type_price_places');
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
            ->integer('ID_TYPE_PRICE_INFO')
            ->requirePresence('ID_TYPE_PRICE_INFO', 'create')
            ->notEmptyString('ID_TYPE_PRICE_INFO');

        $validator
            ->integer('ID_PLACE_PRICE')
            ->requirePresence('ID_PLACE_PRICE', 'create')
            ->notEmptyString('ID_PLACE_PRICE');

        $validator
            ->integer('ACTIVE')
            ->requirePresence('ACTIVE', 'create')
            ->notEmptyString('ACTIVE');

        return $validator;
    }
}
