<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TProduct Model
 *
 * @method \App\Model\Entity\TProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\TProduct newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TProduct|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TProduct[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TProduct findOrCreate($search, callable $callback = null, $options = [])
 */
class TProductTable extends Table
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

        $this->setTable('t_product');
        $this->setDisplayField('ID_PRODUCT');
        $this->setPrimaryKey('ID_PRODUCT');
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
            ->integer('ID_PRODUCT')
            ->allowEmpty('ID_PRODUCT', 'create');

        $validator
            ->scalar('PRODUCT_NAME')
            ->maxLength('PRODUCT_NAME', 100)
            ->allowEmpty('PRODUCT_NAME');

        $validator
            ->integer('ID_MARKET')
            ->requirePresence('ID_MARKET', 'create')
            ->notEmpty('ID_MARKET');

        $validator
            ->integer('ID_CATEGORY_PROD')
            ->requirePresence('ID_CATEGORY_PROD', 'create')
            ->notEmpty('ID_CATEGORY_PROD');

        $validator
            ->integer('ACTIVE')
            ->allowEmpty('ACTIVE');

        return $validator;
    }
}
