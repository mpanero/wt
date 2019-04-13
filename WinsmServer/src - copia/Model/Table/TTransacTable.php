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
 * @method \App\Model\Entity\TTransac|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
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
            ->allowEmpty('ID_TRANSAC', 'create');

        $validator
            ->requirePresence('ID_USER', 'create')
            ->notEmpty('ID_USER');

        $validator
            ->requirePresence('ID_REQUEST', 'create')
            ->notEmpty('ID_REQUEST');

        $validator
            ->requirePresence('ID_TRADE', 'create')
            ->notEmpty('ID_TRADE');

        $validator
            ->integer('SEC')
            ->requirePresence('SEC', 'create')
            ->notEmpty('SEC');

        $validator
            ->requirePresence('ID_TRANSAC_TYPE', 'create')
            ->notEmpty('ID_TRANSAC_TYPE');

        $validator
            ->dateTime('DH_TRANSAC')
            ->requirePresence('DH_TRANSAC', 'create')
            ->notEmpty('DH_TRANSAC');

        $validator
            ->numeric('VALUE')
            ->requirePresence('VALUE', 'create')
            ->notEmpty('VALUE');

        $validator
            ->scalar('INFO')
            ->maxLength('INFO', 1000)
            ->requirePresence('INFO', 'create')
            ->notEmpty('INFO');

        $validator
            ->scalar('COMMENTS')
            ->requirePresence('COMMENTS', 'create')
            ->notEmpty('COMMENTS');

        return $validator;
    }
}
