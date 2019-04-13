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
 * @method \App\Model\Entity\TTrade|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
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
            ->allowEmpty('ID_TRADE', 'create');

        $validator
            ->requirePresence('ID_REQUEST', 'create')
            ->notEmpty('ID_REQUEST');

        $validator
            ->integer('ID_USER_OWNER')
            ->requirePresence('ID_USER_OWNER', 'create')
            ->notEmpty('ID_USER_OWNER');

        $validator
            ->integer('ID_USER_CPART')
            ->requirePresence('ID_USER_CPART', 'create')
            ->notEmpty('ID_USER_CPART');

        $validator
            ->decimal('PRICE')
            ->allowEmpty('PRICE');

        $validator
            ->integer('ID_TP_CURRENCY')
            ->allowEmpty('ID_TP_CURRENCY');

        $validator
            ->decimal('QT')
            ->allowEmpty('QT');

        $validator
            ->integer('ID_UM')
            ->requirePresence('ID_UM', 'create')
            ->notEmpty('ID_UM');

        $validator
            ->integer('CONFIRMED_OWNER')
            ->allowEmpty('CONFIRMED_OWNER');

        $validator
            ->integer('CONFIRMED_CPART')
            ->allowEmpty('CONFIRMED_CPART');

        $validator
            ->dateTime('DH_CREATION')
            ->allowEmpty('DH_CREATION');

        $validator
            ->integer('ID_TP_STATUS_TRADE')
            ->allowEmpty('ID_TP_STATUS_TRADE');
            
        return $validator;
    }

    public function beforeSave($event, $entity, $options) {
        $entity->DH_CREATION = date('Y-m-d H:i:s', strtotime($entity->DH_CREATION));
    }    
}
