<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TTransacType Model
 *
 * @method \App\Model\Entity\TTransacType get($primaryKey, $options = [])
 * @method \App\Model\Entity\TTransacType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TTransacType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TTransacType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TTransacType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TTransacType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TTransacType findOrCreate($search, callable $callback = null, $options = [])
 */
class TTransacTypeTable extends Table
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

        $this->setTable('t_transac_type');
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
            ->integer('ID_TRANSAC_TYPE')
            ->requirePresence('ID_TRANSAC_TYPE', 'create')
            ->notEmpty('ID_TRANSAC_TYPE');

        $validator
            ->scalar('TRANSAC_TYPE_NAME')
            ->maxLength('TRANSAC_TYPE_NAME', 30)
            ->requirePresence('TRANSAC_TYPE_NAME', 'create')
            ->notEmpty('TRANSAC_TYPE_NAME');

        $validator
            ->integer('SIGN')
            ->requirePresence('SIGN', 'create')
            ->notEmpty('SIGN');

        return $validator;
    }
}
