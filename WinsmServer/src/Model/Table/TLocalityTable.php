<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TLocality Model
 *
 * @method \App\Model\Entity\TLocality get($primaryKey, $options = [])
 * @method \App\Model\Entity\TLocality newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TLocality[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TLocality|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TLocality saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TLocality patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TLocality[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TLocality findOrCreate($search, callable $callback = null, $options = [])
 */
class TLocalityTable extends Table
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

        $this->setTable('t_locality');
        $this->setDisplayField('ID_PLACE');
        $this->setPrimaryKey('ID_PLACE');
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
            ->integer('ID_PLACE')
            ->allowEmptyString('ID_PLACE', null, 'create');

        $validator
            ->integer('ID_PROVINCE')
            ->requirePresence('ID_PROVINCE', 'create')
            ->notEmptyString('ID_PROVINCE');

        $validator
            ->scalar('PLACE_NAME')
            ->maxLength('PLACE_NAME', 255)
            ->requirePresence('PLACE_NAME', 'create')
            ->notEmptyString('PLACE_NAME');

        return $validator;
    }
}
