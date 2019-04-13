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
            ->notEmpty('ID_USER', 'create');

        $validator
            ->maxLength('MAIL', 45)
            ->notEmpty('MAIL');

        $validator
            ->integer('ACTIVE')
            ->allowEmpty('ACTIVE');

        $validator
            ->scalar('PASSWORD')
            ->maxLength('PASSWORD', 256)
            ->notEmpty('PASSWORD');

        $validator
            ->maxLength('NAME', 100)
            ->notEmpty('NAME');

        $validator
            ->scalar('SURNAME')
            ->maxLength('SURNAME', 100)
            ->notEmpty('SURNAME');

        $validator
            ->scalar('COMPANY')
            ->maxLength('COMPANY', 60)
            ->notEmpty('COMPANY');
            
        $validator
            ->integer('ID_GENDER')
            ->requirePresence('ID_GENDER', 'create')
            ->notEmpty('ID_GENDER');

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
            ->integer('ID_ROL')
            ->requirePresence('ID_ROL', 'create')
            ->allowEmpty('ID_ROL');

        $validator
            ->requirePresence('ID_PLACE', 'create')
            ->allowEmpty('ID_PLACE');

        return $validator;
    }
}
