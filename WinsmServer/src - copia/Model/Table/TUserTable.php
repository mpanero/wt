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
 * @method \App\Model\Entity\TUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
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
            ->allowEmpty('ID_USER', 'create');

        $validator
            ->scalar('MAIL')
            ->maxLength('MAIL', 45)
            ->allowEmpty('MAIL');

        $validator
            ->integer('ACTIVE')
            ->allowEmpty('ACTIVE');

        $validator
            ->scalar('PASSWORD')
            ->maxLength('PASSWORD', 256)
            ->allowEmpty('PASSWORD');

        $validator
            ->scalar('NAME')
            ->maxLength('NAME', 100)
            ->allowEmpty('NAME');

        $validator
            ->scalar('SURNAME')
            ->maxLength('SURNAME', 100)
            ->allowEmpty('SURNAME');

        $validator
            ->scalar('COMPANY')
            ->maxLength('COMPANY', 60)
            ->allowEmpty('COMPANY');
            
        $validator
            ->scalar('GENDER')
            ->maxLength('GENDER', 45)
            ->allowEmpty('GENDER');

        $validator
            ->date('BIRTHDATE')
            ->allowEmpty('BIRTHDATE');
            
        $validator
            ->scalar('PHONE_MOBILE_COUNTRY')
            ->maxLength('PHONE_MOBILE_COUNTRY', 4)
            ->allowEmpty('PHONE_MOBILE_COUNTRY');    

        $validator
            ->scalar('PHONE_MOBILE_NUM')
            ->maxLength('PHONE_MOBILE_NUM', 45)
            ->allowEmpty('PHONE_MOBILE_NUM');

        $validator
            ->scalar('PHONE_OTHER_COUNTRY')
            ->maxLength('PHONE_OTHER_COUNTRY', 4)
            ->allowEmpty('PHONE_OTHER_COUNTRY'); 

        $validator
            ->scalar('PHONE_OTHER_NUM')
            ->maxLength('PHONE_OTHER_NUM', 45)
            ->allowEmpty('PHONE_OTHER_NUM');

        $validator
            ->requirePresence('ID_PLACE', 'create')
            ->notEmpty('ID_PLACE');

        return $validator;
    }
}
