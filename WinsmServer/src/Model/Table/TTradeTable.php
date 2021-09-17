<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TTrade Model
 *
 * @method \App\Model\Entity\TTrade get($primaryKey, $options = [])
 * @method \App\Model\Entity\TTrade newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TTrade[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TTrade|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TTrade saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TTrade patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TTrade[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TTrade findOrCreate($search, callable $callback = null, $options = [])
 */
class TTradeTable extends Table
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

        $this->setTable('t_trade');
        $this->setDisplayField('ID_TRADE');
        $this->setPrimaryKey('ID_TRADE');

        $this->addBehavior('Timestamp');
        
        $this->belongsTo('TRequest', [
            'foreignKey' => 'ID_REQUEST'
        ]); 

        $this->belongsTo('TUserOwer', [
            'foreignKey' => 'ID_USER_OWNER',
            'className' => 'TUser'
        ]);
        
        $this->belongsTo('TUserCpart', [
            'foreignKey' => 'ID_USER_CPART',
            'className' => 'TUser'
        ]);      
        
        $this->belongsTo('TCurrency', [
            'foreignKey' => 'ID_TP_CURRENCY'
        ]);
        
        $this->belongsTo('TUm', [
            'foreignKey' => 'ID_UM'
        ]); 
        
        $this->belongsTo('TTypes', [
            'foreignKey' => 'ID_TP_STATUS_TRADE'
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
            ->allowEmptyString('ID_TRADE', null, 'create');

        $validator
            ->requirePresence('ID_REQUEST', 'create')
            ->notEmptyString('ID_REQUEST');

        $validator
            ->scalar('COD_REF')
            ->maxLength('COD_REF', 20)
            ->allowEmptyString('COD_REF');

        $validator
            ->integer('ID_USER_OWNER')
            ->requirePresence('ID_USER_OWNER', 'create')
            ->notEmptyString('ID_USER_OWNER');

        $validator
            ->integer('ID_USER_CPART')
            ->requirePresence('ID_USER_CPART', 'create')
            ->notEmptyString('ID_USER_CPART');

        $validator
            ->decimal('PRICE')
            ->allowEmptyString('PRICE');

        $validator
            ->integer('ID_TP_CURRENCY')
            ->allowEmptyString('ID_TP_CURRENCY');

        $validator
            ->decimal('QT')
            ->allowEmptyString('QT');

        $validator
            ->integer('ID_UM')
            ->requirePresence('ID_UM', 'create')
            ->notEmptyString('ID_UM');

        $validator
            ->integer('CONFIRMED_OWNER')
            ->allowEmptyString('CONFIRMED_OWNER');

        $validator
            ->integer('CONFIRMED_CPART')
            ->allowEmptyString('CONFIRMED_CPART');

        $validator
            ->dateTime('DH_CREATION')
            ->allowEmptyDateTime('DH_CREATION');

        $validator
            ->integer('ID_TP_STATUS_TRADE')
            ->allowEmptyString('ID_TP_STATUS_TRADE');

        $validator
            ->integer('ID_TYPE_PRICE')
            ->allowEmptyString('ID_TYPE_PRICE');

        $validator
            ->integer('ID_PRICE_REF')
            ->allowEmptyString('ID_PRICE_REF');

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
            ->integer('ID_TYPE_DELIVERY')
            ->allowEmptyString('ID_TYPE_DELIVERY');

        $validator
            ->integer('TYPE_QUALITY')
            ->allowEmptyString('TYPE_QUALITY');

        $validator
            ->scalar('QUALITY_INFO')
            ->maxLength('QUALITY_INFO', 100)
            ->allowEmptyString('QUALITY_INFO');

        return $validator;
    }
}
