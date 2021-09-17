<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TUserRoles Model
 *
 * @method \App\Model\Entity\TUserRole get($primaryKey, $options = [])
 * @method \App\Model\Entity\TUserRole newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TUserRole[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TUserRole|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TUserRole saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TUserRole patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TUserRole[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TUserRole findOrCreate($search, callable $callback = null, $options = [])
 */
class TUserRolesTable extends Table
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

        $this->setTable('t_user_roles');
        $this->setDisplayField('ID_ROL');
        $this->setPrimaryKey('ID_ROL');
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
            ->integer('ID_ROL')
            ->allowEmptyString('ID_ROL', null, 'create');

        $validator
            ->scalar('DESCRIPTION')
            ->maxLength('DESCRIPTION', 45)
            ->requirePresence('DESCRIPTION', 'create')
            ->notEmptyString('DESCRIPTION');

        $validator
            ->integer('ACTIVE')
            ->notEmptyString('ACTIVE');

        return $validator;
    }
}
