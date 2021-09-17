<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TRelProdTypePrice Model
 *
 * @method \App\Model\Entity\TRelProdTypePrice get($primaryKey, $options = [])
 * @method \App\Model\Entity\TRelProdTypePrice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TRelProdTypePrice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TRelProdTypePrice|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TRelProdTypePrice saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TRelProdTypePrice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TRelProdTypePrice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TRelProdTypePrice findOrCreate($search, callable $callback = null, $options = [])
 */
class TRelProdTypePriceTable extends Table
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

        $this->setTable('t_rel_prod_type_price');
        $this->belongsTo('TTypes', [
            'foreignKey' => 'ID_TYPE_PRICE'
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
            ->integer('ID_CATEGORY_PROD')
            ->requirePresence('ID_CATEGORY_PROD', 'create')
            ->notEmptyString('ID_CATEGORY_PROD');

        $validator
            ->integer('ID_TYPE_PRICE')
            ->requirePresence('ID_TYPE_PRICE', 'create')
            ->notEmptyString('ID_TYPE_PRICE');

        return $validator;
    }
}
