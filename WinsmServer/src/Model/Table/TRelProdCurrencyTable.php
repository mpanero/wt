<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TRelProdCurrency Model
 *
 * @method \App\Model\Entity\TRelProdCurrency get($primaryKey, $options = [])
 * @method \App\Model\Entity\TRelProdCurrency newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TRelProdCurrency[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TRelProdCurrency|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TRelProdCurrency saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TRelProdCurrency patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TRelProdCurrency[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TRelProdCurrency findOrCreate($search, callable $callback = null, $options = [])
 */
class TRelProdCurrencyTable extends Table
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

        $this->setTable('t_rel_prod_currency');
        $this->belongsTo('TCurrency', [
            'foreignKey' => 'ID_CURRENCY'
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
            ->integer('ID_CURRENCY')
            ->requirePresence('ID_CURRENCY', 'create')
            ->notEmptyString('ID_CURRENCY');

        return $validator;
    }
}
