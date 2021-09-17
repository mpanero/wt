<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TRequest Model
 *
 * @method \App\Model\Entity\TRequest get($primaryKey, $options = [])
 * @method \App\Model\Entity\TRequest newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TRequest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TRequest|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TRequest saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TRequest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TRequest[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TRequest findOrCreate($search, callable $callback = null, $options = [])
 */
class TRequestTable extends Table
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

        $this->setTable('t_request');
        $this->setDisplayField('ID_REQUEST');
        $this->setPrimaryKey('ID_REQUEST');

        $this->addBehavior('Timestamp');

        $this->belongsTo('TMarket', [
            'foreignKey' => 'ID_MARKET'
        ]);
        $this->belongsTo('TProduct', [
            'foreignKey' => 'ID_PRODUCT'
        ]);
        $this->belongsTo('TLocality', [
            'foreignKey' => 'ID_PLACE_DELIVERY'
        ]);
        $this->belongsTo('TLocality', [
            'foreignKey' => 'ID_PLACE_ORIGIN'
        ]);
        $this->belongsTo('TUser', [
            'foreignKey' => 'ID_USER_OWNER'
        ]);
        $this->belongsTo('TUm', [
            'foreignKey' => 'ID_UM'
        ]);      
        $this->belongsTo('TCurrency', [
            'foreignKey' => 'ID_TP_CURRENCY'
        ]);
        $this->belongsTo('TTypes', [
            'foreignKey' => 'ID_TP_STATUS_REQ'
        ]);                  
        $this->belongsTo('TTypes', [
            'foreignKey' => 'ID_TP_OPERATION'
        ]);
        $this->belongsTo('TTypes', [
            'foreignKey' => 'ID_TYPE_PAYMENT'
        ]); 
        $this->belongsTo('TTypes', [
            'foreignKey' => 'DELIVERY_METHOD'
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
            ->allowEmptyString('ID_REQUEST', null, 'create');

        $validator
            ->integer('ID_USER_OWNER')
            ->requirePresence('ID_USER_OWNER', 'create')
            ->notEmptyString('ID_USER_OWNER');

        $validator
            ->dateTime('DH_REQUEST')
            ->allowEmptyDateTime('DH_REQUEST');

        $validator
            ->integer('ID_TP_OPERATION')
            ->allowEmptyString('ID_TP_OPERATION');

        $validator
            ->integer('ID_MARKET')
            ->requirePresence('ID_MARKET', 'create')
            ->notEmptyString('ID_MARKET');

        $validator
            ->integer('ID_TP_BUSINESS')
            ->allowEmptyString('ID_TP_BUSINESS');

        $validator
            ->integer('ID_PRODUCT')
            ->requirePresence('ID_PRODUCT', 'create')
            ->notEmptyString('ID_PRODUCT');

        $validator
            ->integer('PRICE_FROM')
            ->allowEmptyString('PRICE_FROM');

        $validator
            ->integer('PRICE_TO')
            ->allowEmptyString('PRICE_TO');

        $validator
            ->integer('ID_TP_CURRENCY')
            ->allowEmptyString('ID_TP_CURRENCY');

        $validator
            ->allowEmptyString('QT_FROM');

        $validator
            ->allowEmptyString('QT_TO');

        $validator
            ->integer('ID_UM')
            ->allowEmptyString('ID_UM');

        $validator
            ->dateTime('DT_FROM')
            ->allowEmptyDateTime('DT_FROM');

        $validator
            ->dateTime('DT_TO')
            ->allowEmptyDateTime('DT_TO');

        $validator
            ->allowEmptyString('ID_PLACE_DELIVERY');

        $validator
            ->integer('LOC_DISTANCE')
            ->allowEmptyString('LOC_DISTANCE');

        $validator
            ->scalar('LOG')
            ->maxLength('LOG', 100)
            ->allowEmptyString('LOG');

        $validator
            ->integer('ID_TP_STATUS_REQ')
            ->allowEmptyString('ID_TP_STATUS_REQ');

        $validator
            ->dateTime('DH_LAST_UPDATE')
            ->allowEmptyDateTime('DH_LAST_UPDATE');

        $validator
            ->integer('ID_TYPE_PRICE')
            ->requirePresence('ID_TYPE_PRICE', 'create')
            ->notEmptyString('ID_TYPE_PRICE');

        $validator
            ->integer('ID_PRICE_REF')
            ->allowEmptyString('ID_PRICE_REF');

        $validator
            ->integer('ID_POSITION')
            ->allowEmptyString('ID_POSITION');

        $validator
            ->dateTime('DT_PRICE_FIX_FROM')
            ->allowEmptyDateTime('DT_PRICE_FIX_FROM');

        $validator
            ->dateTime('DT_PRICE_FIX_TO')
            ->allowEmptyDateTime('DT_PRICE_FIX_TO');

        $validator
            ->integer('ID_CROP')
            ->allowEmptyString('ID_CROP');

        $validator
            ->integer('ID_TYPE_PAYMENT')
            ->allowEmptyString('ID_TYPE_PAYMENT');

        $validator
            ->integer('ID_PLACE_ORIGIN')
            ->allowEmptyString('ID_PLACE_ORIGIN');

        $validator
            ->integer('ID_TYPE_DELIVERY')
            ->allowEmptyString('ID_TYPE_DELIVERY');

        $validator
            ->integer('DELIVERY_METHOD')
            ->allowEmptyString('DELIVERY_METHOD');

        $validator
            ->integer('DELIVERY_AMOUNT')
            ->allowEmptyString('DELIVERY_AMOUNT');

        $validator
            ->integer('TYPE_QUALITY')
            ->allowEmptyString('TYPE_QUALITY');

        $validator
            ->scalar('QUALITY_INFO')
            ->maxLength('QUALITY_INFO', 100)
            ->allowEmptyString('QUALITY_INFO');

        $validator
            ->integer('ACTIVE')
            ->notEmptyString('ACTIVE');

        return $validator;
    }
}
