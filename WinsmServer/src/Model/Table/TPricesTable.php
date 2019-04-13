<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TPrices Model
 *
 * @method \App\Model\Entity\TPrice get($primaryKey, $options = [])
 * @method \App\Model\Entity\TPrice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TPrice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TPrice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TPrice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TPrice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TPrice findOrCreate($search, callable $callback = null, $options = [])
 */
class TPricesTable extends Table
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

        $this->setTable('t_prices');
        $this->setDisplayField('ID');
        $this->setPrimaryKey('ID');      
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
            ->allowEmpty('ID', 'create');

        $validator
            ->integer('ID_TYPE_PRICE_INFO')
            ->requirePresence('ID_TYPE_PRICE_INFO', 'create')
            ->notEmpty('ID_TYPE_PRICE_INFO');

        $validator
            ->integer('ID_PRODUCT')
            ->requirePresence('ID_PRODUCT', 'create')
            ->notEmpty('ID_PRODUCT');

        $validator
            ->date('DATE_PRICE')
            ->requirePresence('DATE_PRICE', 'create')
            ->notEmpty('DATE_PRICE');

        $validator
            ->integer('ID_PLACE_PRICE')
            ->requirePresence('ID_PLACE_PRICE', 'create')
            ->notEmpty('ID_PLACE_PRICE');

        $validator
            ->numeric('PRICE_VALUE')
            ->requirePresence('PRICE_VALUE', 'create')
            ->notEmpty('PRICE_VALUE');

        $validator
            ->integer('ID_TYPE_CURRENCY')
            ->requirePresence('ID_TYPE_CURRENCY', 'create')
            ->notEmpty('ID_TYPE_CURRENCY');

        $validator
            ->numeric('VAR')
            ->requirePresence('VAR', 'create')
            ->notEmpty('VAR');

        $validator
            ->integer('ID_POSITION')
            ->requirePresence('ID_POSITION', 'create')
            ->notEmpty('ID_POSITION');

        $validator
            ->dateTime('UPDATED')
            ->requirePresence('UPDATED', 'create')
            ->notEmpty('UPDATED');

        return $validator;
    }
}
