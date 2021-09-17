<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TUser Model
 *
 * @method \App\Model\Entity\TUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\TUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TUser|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TUser saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TUser findOrCreate($search, callable $callback = null, $options = [])
 */
class TUserTable extends Table
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

        $this->setTable('t_user');
        $this->setDisplayField('ID_USER');
        $this->setPrimaryKey('ID_USER');


        $this->addBehavior('Timestamp');
        
        $this->belongsTo('TGender', [
            'foreignKey' => 'ID_GENDER'
        ]);

        $this->belongsTo('TUserRoles', [
            'foreignKey' => 'ID_ROL'
        ]);

        $this->belongsTo('TPlace', [
            'foreignKey' => 'ID_PLACE'
        ]);   

        $this->belongsToMany( 'TTypeActivity', [
            'foreignKey' => 'ACTIVITY'
        ] );         
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
            ->integer('ID_USER')
            ->allowEmptyString('ID_USER', null, 'create');

        $validator
            ->scalar('MAIL')
            ->maxLength('MAIL', 45)
            ->allowEmptyString('MAIL');

        $validator
            ->integer('ACTIVE')
            ->allowEmptyString('ACTIVE');

        $validator
            ->scalar('PASSWORD')
            ->maxLength('PASSWORD', 255)
            ->allowEmptyString('PASSWORD');

        $validator
            ->scalar('NAME')
            ->maxLength('NAME', 100)
            ->allowEmptyString('NAME');

        $validator
            ->scalar('SURNAME')
            ->maxLength('SURNAME', 100)
            ->allowEmptyString('SURNAME');

        $validator
            ->scalar('COMPANY')
            ->maxLength('COMPANY', 60)
            ->allowEmptyString('COMPANY');

        $validator
            ->integer('ID_GENDER')
            ->allowEmptyString('ID_GENDER');

        $validator
            ->date('BIRTHDATE')
            ->allowEmptyDate('BIRTHDATE');

        $validator
            ->integer('PHONE_MOBILE_COUNTRY')
            ->allowEmptyString('PHONE_MOBILE_COUNTRY');

        $validator
            ->notEmptyString('PHONE_MOBILE_NUM');

        $validator
            ->integer('PHONE_OTHER_COUNTRY')
            ->allowEmptyString('PHONE_OTHER_COUNTRY');

        $validator
            ->allowEmptyString('PHONE_OTHER_NUM');

        $validator
            ->integer('ID_ROL')
            ->allowEmptyString('ID_ROL');

        $validator
            ->allowEmptyString('ID_PLACE');

        $validator
            ->integer('ID_LEGAL')
            ->allowEmptyString('ID_LEGAL');

        $validator
            ->scalar('ACTIVITY')
            ->maxLength('ACTIVITY', 20)
            ->allowEmptyString('ACTIVITY');

        $validator
            ->integer('ID_TYPE_STATUS_USER')
            ->allowEmptyString('ID_TYPE_STATUS_USER');

        $validator
            ->integer('Q1')
            ->allowEmptyString('Q1');

        $validator
            ->integer('Q2')
            ->allowEmptyString('Q2');

        $validator
            ->integer('Q3')
            ->allowEmptyString('Q3');

        $validator
            ->integer('USER_ADMIN')
            ->allowEmptyString('USER_ADMIN');

        return $validator;
    }
}
