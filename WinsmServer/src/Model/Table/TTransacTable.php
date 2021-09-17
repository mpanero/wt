<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TTransac Model
 *
 * @method \App\Model\Entity\TTransac get($primaryKey, $options = [])
 * @method \App\Model\Entity\TTransac newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TTransac[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TTransac|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TTransac saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TTransac patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TTransac[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TTransac findOrCreate($search, callable $callback = null, $options = [])
 */
class TTransacTable extends Table
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

        $this->setTable('t_transac');
        $this->setDisplayField('ID_TRANSAC');
        $this->setPrimaryKey('ID_TRANSAC');
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
            ->allowEmptyString('ID_TRANSAC', null, 'create');

        $validator
            ->requirePresence('ID_USER', 'create')
            ->notEmptyString('ID_USER');

        $validator
            ->requirePresence('ID_REQUEST', 'create')
            ->notEmptyString('ID_REQUEST');

        $validator
            ->requirePresence('ID_TRADE', 'create')
            ->notEmptyString('ID_TRADE');

        $validator
            ->integer('SEC')
            ->notEmptyString('SEC');

        $validator
            ->requirePresence('ID_TRANSAC_TYPE', 'create')
            ->notEmptyString('ID_TRANSAC_TYPE');

        $validator
            ->dateTime('DH_TRANSAC')
            ->notEmptyDateTime('DH_TRANSAC');

        $validator
            ->numeric('VALUE')
            ->notEmptyString('VALUE');

        $validator
            ->scalar('INFO')
            ->maxLength('INFO', 1000)
            ->requirePresence('INFO', 'create')
            ->notEmptyString('INFO');

        $validator
            ->scalar('COMMENTS')
            ->requirePresence('COMMENTS', 'create')
            ->notEmptyString('COMMENTS');

        return $validator;
    }
}
