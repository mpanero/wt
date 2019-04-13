<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TGender Model
 *
 * @method \App\Model\Entity\TGender get($primaryKey, $options = [])
 * @method \App\Model\Entity\TGender newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TGender[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TGender|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TGender patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TGender[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TGender findOrCreate($search, callable $callback = null, $options = [])
 */
class TGenderTable extends Table
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

        $this->setTable('t_gender');
        $this->setDisplayField('ID_GENDER');
        $this->setPrimaryKey('ID_GENDER');
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
            ->integer('ID_GENDER')
            ->allowEmpty('ID_GENDER', 'create')
            ->add('ID_GENDER', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('GENDER_NAME')
            ->maxLength('GENDER_NAME', 50)
            ->requirePresence('GENDER_NAME', 'create')
            ->notEmpty('GENDER_NAME');

        $validator
            ->scalar('GENDER_INI')
            ->maxLength('GENDER_INI', 1)
            ->allowEmpty('GENDER_INI');

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
        $rules->add($rules->isUnique(['ID_GENDER']));

        return $rules;
    }
}
