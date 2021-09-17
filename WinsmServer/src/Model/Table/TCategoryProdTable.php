<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TCategoryProd Model
 *
 * @method \App\Model\Entity\TCategoryProd get($primaryKey, $options = [])
 * @method \App\Model\Entity\TCategoryProd newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TCategoryProd[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TCategoryProd|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TCategoryProd saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TCategoryProd patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TCategoryProd[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TCategoryProd findOrCreate($search, callable $callback = null, $options = [])
 */
class TCategoryProdTable extends Table
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

        $this->setTable('t_category_prod');
        $this->setDisplayField('ID_CATEGORY_PROD');
        $this->setPrimaryKey('ID_CATEGORY_PROD');
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
            ->integer('ID_CATEGORY_PROD')
            ->allowEmptyString('ID_CATEGORY_PROD', null, 'create');

        $validator
            ->scalar('CATEGORY_PROD_NAME')
            ->maxLength('CATEGORY_PROD_NAME', 100)
            ->allowEmptyString('CATEGORY_PROD_NAME');

        $validator
            ->integer('ID_MARKET')
            ->requirePresence('ID_MARKET', 'create')
            ->notEmptyString('ID_MARKET');

        $validator
            ->integer('ACTIVE')
            ->notEmptyString('ACTIVE');

        return $validator;
    }
}
