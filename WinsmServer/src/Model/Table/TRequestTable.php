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
 * @method \App\Model\Entity\TRequest|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
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
        $this->belongsTo('TPlace', [
            'foreignKey' => 'ID_PLACE_DELIVERY'
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
            ->allowEmpty('ID_REQUEST', 'create');

        $validator
            ->integer('ID_USER_OWNER')
            ->requirePresence('ID_USER_OWNER', 'create')
            ->notEmpty('ID_USER_OWNER');

        $validator
            ->dateTime('DH_REQUEST')
            ->allowEmpty('DH_REQUEST');

        $validator
            ->integer('ID_TP_OPERATION')
            ->allowEmpty('ID_TP_OPERATION');

        $validator
            ->integer('ID_MARKET')
            ->requirePresence('ID_MARKET', 'create')
            ->notEmpty('ID_MARKET');

        $validator
            ->integer('ID_TP_BUSINESS')
            ->allowEmpty('ID_TP_BUSINESS');

        $validator
            ->integer('ID_PRODUCT')
            ->requirePresence('ID_PRODUCT', 'create')
            ->notEmpty('ID_PRODUCT');

        $validator
            ->integer('PRICE_FROM')
            ->allowEmpty('PRICE_FROM');

        $validator
            ->integer('PRICE_TO')
            ->allowEmpty('PRICE_TO');

        $validator
            ->integer('ID_TP_CURRENCY')
            ->allowEmpty('ID_TP_CURRENCY');

        $validator
            ->allowEmpty('QT_FROM');

        $validator
            ->allowEmpty('QT_TO');

        $validator
            ->integer('ID_UM')
            ->allowEmpty('ID_UM');

        $validator
            ->dateTime('DT_FROM')
            ->allowEmpty('DT_FROM');

        $validator
            ->dateTime('DT_TO')
            ->allowEmpty('DT_TO');

        $validator
            ->integer('ID_PLACE_DELIVERY')
            ->allowEmpty('ID_PLACE_DELIVERY');

        $validator
            ->integer('LOC_DISTANCE')
            ->allowEmpty('LOC_DISTANCE');

        $validator
            ->maxLength('LOG', 100)
            ->allowEmpty('LOG');

        $validator
            ->integer('ID_TP_STATUS_REQ')
            ->allowEmpty('ID_TP_STATUS_REQ');

        $validator
            ->dateTime('DH_LAST_UPDATE')
            ->allowEmpty('DH_LAST_UPDATE');

        $validator
            ->integer('ID_TYPE_PRICE')
            ->allowEmpty('ID_TYPE_PRICE');

        $validator
            ->integer('ID_PRICE_REF')
            ->allowEmpty('ID_PRICE_REF');

        $validator
            ->dateTime('DT_PRICE_FIX_FROM')
            ->allowEmpty('DT_PRICE_FIX_FROM');

        $validator
            ->dateTime('DT_PRICE_FIX_TO')
            ->allowEmpty('DT_PRICE_FIX_TO');

        $validator
            ->integer('ID_CROP')
            ->allowEmpty('ID_CROP');

        $validator
            ->integer('ID_TYPE_PAYMENT')
            ->allowEmpty('ID_TYPE_PAYMENT');            
            
        $validator
            ->integer('ID_TYPE_DELIVERY')
            ->allowEmpty('ID_TYPE_DELIVERY');

        $validator
            ->integer('TYPE_QUALITY')
            ->allowEmpty('TYPE_QUALITY');

        $validator
            ->maxLength('QUALITY_INFO', 100)
            ->allowEmpty('QUALITY_INFO');

        $validator
            ->integer('ACTIVE')
            ->requirePresence('ACTIVE', 'create')
            ->notEmpty('ACTIVE');

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
        $rules->add($rules->isUnique(['ID_REQUEST']));
        $rules->add($rules->existsIn(['ID_MARKET'], 'TMarket'));
        $rules->add($rules->existsIn(['ID_PRODUCT'], 'TProduct'));
        $rules->add($rules->existsIn(['ID_PLACE_DELIVERY'], 'TPlace'));
        $rules->add($rules->existsIn(['ID_USER_OWNER'], 'TUser'));
        /*$rules->add($rules->existsIn(['ID_TP_OPERATION'], 'TType'));*/
        /*$rules->add($rules->existsIn(['ID_TP_BUSINESS'], 'TType'));*/
        /*$rules->add($rules->existsIn(['ID_TP_CURRENCY'], 'TCurrency'));*/

        return $rules;
    }     
}
