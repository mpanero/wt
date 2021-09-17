<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TNotifications Model
 *
 * @method \App\Model\Entity\TNotification get($primaryKey, $options = [])
 * @method \App\Model\Entity\TNotification newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TNotification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TNotification|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TNotification saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TNotification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TNotification[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TNotification findOrCreate($search, callable $callback = null, $options = [])
 */
class TNotificationsTable extends Table
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

        $this->setTable('t_notifications');
        $this->setDisplayField('ID_NOTIF');
        $this->setPrimaryKey('ID_NOTIF');
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
            ->allowEmptyString('ID_NOTIF', null, 'create');

        $validator
            ->integer('ID_TYPE_NOTIF')
            ->requirePresence('ID_TYPE_NOTIF', 'create')
            ->notEmptyString('ID_TYPE_NOTIF');

        $validator
            ->integer('ID_USER')
            ->requirePresence('ID_USER', 'create')
            ->notEmptyString('ID_USER');

        $validator
            ->scalar('DESCRIPTION')
            ->maxLength('DESCRIPTION', 100)
            ->requirePresence('DESCRIPTION', 'create')
            ->notEmptyString('DESCRIPTION');

        $validator
            ->integer('READ_NOTIF')
            ->notEmptyString('READ_NOTIF');

        $validator
            ->dateTime('DT_CREATED')
            ->requirePresence('DT_CREATED', 'create')
            ->notEmptyDateTime('DT_CREATED');

        $validator
            ->scalar('COD_REF')
            ->maxLength('COD_REF', 20)
            ->allowEmptyString('COD_REF');

        return $validator;
    }
}
