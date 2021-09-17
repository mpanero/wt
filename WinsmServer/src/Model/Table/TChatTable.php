<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TChat Model
 *
 * @method \App\Model\Entity\TChat get($primaryKey, $options = [])
 * @method \App\Model\Entity\TChat newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TChat[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TChat|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TChat saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TChat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TChat[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TChat findOrCreate($search, callable $callback = null, $options = [])
 */
class TChatTable extends Table
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

        $this->setTable('t_chat');
        $this->setDisplayField('ID_CHAT');
        $this->setPrimaryKey('ID_CHAT');
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
            ->allowEmptyString('ID_CHAT', null, 'create');

        $validator
            ->integer('ID_TRADE')
            ->requirePresence('ID_TRADE', 'create')
            ->notEmptyString('ID_TRADE');

        $validator
            ->scalar('COD_REF')
            ->maxLength('COD_REF', 20)
            ->allowEmptyString('COD_REF');

        $validator
            ->integer('ID_USER_ORIGEN')
            ->requirePresence('ID_USER_ORIGEN', 'create')
            ->notEmptyString('ID_USER_ORIGEN');

        $validator
            ->integer('ID_USER_DESTINY')
            ->requirePresence('ID_USER_DESTINY', 'create')
            ->notEmptyString('ID_USER_DESTINY');

        $validator
            ->scalar('SMS')
            ->maxLength('SMS', 250)
            ->requirePresence('SMS', 'create')
            ->notEmptyString('SMS');

        $validator
            ->integer('READ_CHAT')
            ->allowEmptyString('READ_CHAT');

        $validator
            ->dateTime('DT_CREATED')
            ->requirePresence('DT_CREATED', 'create')
            ->notEmptyDateTime('DT_CREATED');

        $validator
            ->integer('VERIFIED')
            ->notEmptyString('VERIFIED');

        return $validator;
    }
}
