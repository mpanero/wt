<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TAlarms Model
 *
 * @method \App\Model\Entity\TAlarm get($primaryKey, $options = [])
 * @method \App\Model\Entity\TAlarm newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TAlarm[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TAlarm|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TAlarm saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TAlarm patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TAlarm[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TAlarm findOrCreate($search, callable $callback = null, $options = [])
 */
class TAlarmsTable extends Table
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

        $this->setTable('t_alarms');
        $this->setDisplayField('ID_ALARM');
        $this->setPrimaryKey('ID_ALARM');
        
        $this->addBehavior('Timestamp');
        
        $this->belongsTo('TPlacesPrice', [
            'foreignKey' => 'ID_PLACE_PRICE'
        ]);  
        $this->belongsTo('TMarket', [
            'foreignKey' => 'ID_MARKET'
        ]);  
        $this->belongsTo('TProductsPrice', [
            'foreignKey' => 'ID_PRODUCT'
        ]);
        $this->belongsTo('TUser', [
            'foreignKey' => 'ID_USER'
        ]);
        $this->belongsTo('TTypes', [
            'foreignKey' => 'ID_TYPE_PRICE'
        ]);                        
        $this->belongsTo('TCurrency', [
            'foreignKey' => 'ID_CURRENCY'
        ]); 
        $this->belongsTo('TTypes', [
            'foreignKey' => 'ID_TP_OPERATION'
        ]); 
        $this->belongsTo('TPosition', [
            'foreignKey' => 'ID_POSITION'
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
            ->allowEmptyString('ID_ALARM', null, 'create');

        $validator
            ->integer('ID_USER')
            ->requirePresence('ID_USER', 'create')
            ->notEmptyString('ID_USER');

        $validator
            ->integer('ID_PLACE_PRICE')
            ->allowEmptyString('ID_PLACE_PRICE');

        $validator
            ->integer('ID_MARKET')
            ->notEmptyString('ID_MARKET');

        $validator
            ->integer('ID_PRODUCT')
            ->notEmptyString('ID_PRODUCT');

        $validator
            ->integer('ID_TYPE_PRICE')
            ->notEmptyString('ID_TYPE_PRICE');

        $validator
            ->numeric('PRICE_FROM')
            ->notEmptyString('PRICE_FROM');

        $validator
            ->numeric('PRICE_TO')
            ->notEmptyString('PRICE_TO');

        $validator
            ->integer('ID_CURRENCY')
            ->requirePresence('ID_CURRENCY', 'create')
            ->notEmptyString('ID_CURRENCY');

        $validator
            ->integer('AUT_GENERATION')
            ->notEmptyString('AUT_GENERATION');

        $validator
            ->integer('ID_TP_OPERATION')
            ->allowEmptyString('ID_TP_OPERATION');

        $validator
            ->integer('ID_POSITION')
            ->allowEmptyString('ID_POSITION');

        $validator
            ->integer('ACTIVE')
            ->notEmptyString('ACTIVE');

        return $validator;
    }
}
