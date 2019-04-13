<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TCurrency Model
 *
 * @method \App\Model\Entity\TCurrency get($primaryKey, $options = [])
 * @method \App\Model\Entity\TCurrency newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TCurrency[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TCurrency|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TCurrency patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TCurrency[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TCurrency findOrCreate($search, callable $callback = null, $options = [])
 */
class TCurrencyTable extends Table
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

        $this->setTable('t_currency');
        $this->setDisplayField('ID_CURRENCY');
        $this->setPrimaryKey('ID_CURRENCY');
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
            ->integer('ID_CURRENCY')
            ->allowEmpty('ID_CURRENCY', 'create');

        $validator
            ->scalar('CURRENCY_NAME')
            ->maxLength('CURRENCY_NAME', 45)
            ->allowEmpty('CURRENCY_NAME');

        $validator
            ->integer('ID_COUNTRY')
            ->allowEmpty('ID_COUNTRY');

        return $validator;
    }
}
