<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TProductsPrice Model
 *
 * @method \App\Model\Entity\TProductsPrice get($primaryKey, $options = [])
 * @method \App\Model\Entity\TProductsPrice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TProductsPrice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TProductsPrice|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TProductsPrice saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TProductsPrice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TProductsPrice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TProductsPrice findOrCreate($search, callable $callback = null, $options = [])
 */
class TProductsPriceTable extends Table
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

        $this->setTable('t_products_price');
        $this->setDisplayField('ID_PRODUCT_PRICE');
        $this->setPrimaryKey('ID_PRODUCT_PRICE');
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
            ->integer('ID_PRODUCT_PRICE')
            ->allowEmptyString('ID_PRODUCT_PRICE', null, 'create');

        $validator
            ->scalar('PRODUCT_NAME')
            ->maxLength('PRODUCT_NAME', 50)
            ->requirePresence('PRODUCT_NAME', 'create')
            ->notEmptyString('PRODUCT_NAME');

        $validator
            ->integer('ACTIVE')
            ->requirePresence('ACTIVE', 'create')
            ->notEmptyString('ACTIVE');

        $validator
            ->integer('ID_COUNTRY')
            ->requirePresence('ID_COUNTRY', 'create')
            ->notEmptyString('ID_COUNTRY');

        $validator
            ->integer('ORDER_INFO')
            ->requirePresence('ORDER_INFO', 'create')
            ->notEmptyString('ORDER_INFO');

        return $validator;
    }
}
