<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TPlacesPrice Model
 *
 * @method \App\Model\Entity\TPlacesPrice get($primaryKey, $options = [])
 * @method \App\Model\Entity\TPlacesPrice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TPlacesPrice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TPlacesPrice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TPlacesPrice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TPlacesPrice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TPlacesPrice findOrCreate($search, callable $callback = null, $options = [])
 */
class TPlacesPriceTable extends Table
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

        $this->setTable('t_places_price');
        $this->setDisplayField('ID_PLACE_PRICE');
        $this->setPrimaryKey('ID_PLACE_PRICE');
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
            ->integer('ID_PLACE_PRICE')
            ->allowEmpty('ID_PLACE_PRICE', 'create');

        $validator
            ->maxLength('PLACE_NAME', 50)
            ->requirePresence('PLACE_NAME', 'create')
            ->notEmpty('PLACE_NAME');

        $validator
            ->integer('ID_COUNTRY')
            ->requirePresence('ID_COUNTRY', 'create')
            ->notEmpty('ID_COUNTRY');

        $validator
            ->integer('ACTIVE')
            ->requirePresence('ACTIVE', 'create')
            ->notEmpty('ACTIVE');

        $validator
            ->integer('ORDER_INFO')
            ->requirePresence('ORDER_INFO', 'create')
            ->notEmpty('ORDER_INFO');

        return $validator;
    }
}
