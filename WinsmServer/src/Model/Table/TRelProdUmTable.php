<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TRelProdUm Model
 *
 * @method \App\Model\Entity\TRelProdUm get($primaryKey, $options = [])
 * @method \App\Model\Entity\TRelProdUm newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TRelProdUm[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TRelProdUm|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TRelProdUm saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TRelProdUm patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TRelProdUm[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TRelProdUm findOrCreate($search, callable $callback = null, $options = [])
 */
class TRelProdUmTable extends Table
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

        $this->setTable('t_rel_prod_um');

        $this->belongsTo('TUm', [
            'foreignKey' => 'ID_UM'
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
            ->integer('ID_UM')
            ->requirePresence('ID_UM', 'create')
            ->notEmptyString('ID_UM');

        return $validator;
    }
}
