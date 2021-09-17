<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TProfileUser Model
 *
 * @method \App\Model\Entity\TProfileUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\TProfileUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TProfileUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TProfileUser|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TProfileUser saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TProfileUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TProfileUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TProfileUser findOrCreate($search, callable $callback = null, $options = [])
 */
class TProfileUserTable extends Table
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

        $this->setTable('t_profile_user');
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
            ->requirePresence('ID_USER', 'create')
            ->notEmptyString('ID_USER');

        $validator
            ->integer('ID_ACTIVITY')
            ->requirePresence('ID_ACTIVITY', 'create')
            ->notEmptyString('ID_ACTIVITY');

        $validator
            ->integer('VALUE')
            ->requirePresence('VALUE', 'create')
            ->notEmptyString('VALUE');

        return $validator;
    }
}
