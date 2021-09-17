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
 * @method \App\Model\Entity\TProduct|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TProduct saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
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

        $this->belongsTo('TCategoryProd', [
            'foreignKey' => 'ID_CATEGORY_PROD'
        ]);         
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
            ->allowEmptyString('ID_PRODUCT', null, 'create');

        $validator
            ->scalar('PRODUCT_NAME')
            ->maxLength('PRODUCT_NAME', 100)
            ->allowEmptyString('PRODUCT_NAME');

        $validator
            ->scalar('ACRONYM')
            ->maxLength('ACRONYM', 10)
            ->allowEmptyString('ACRONYM');

        $validator
            ->integer('ID_MARKET')
            ->requirePresence('ID_MARKET', 'create')
            ->notEmptyString('ID_MARKET');

        $validator
            ->integer('ID_CATEGORY_PROD')
            ->requirePresence('ID_CATEGORY_PROD', 'create')
            ->notEmptyString('ID_CATEGORY_PROD');

        $validator
            ->scalar('ICON_PATH')
            ->maxLength('ICON_PATH', 100)
            ->requirePresence('ICON_PATH', 'create')
            ->notEmptyString('ICON_PATH');

        $validator
            ->integer('ACTIVE')
            ->allowEmptyString('ACTIVE');

        return $validator;
    }
}
