<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TPlace Model
 *
 * @method \App\Model\Entity\TPlace get($primaryKey, $options = [])
 * @method \App\Model\Entity\TPlace newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TPlace[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TPlace|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TPlace patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TPlace[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TPlace findOrCreate($search, callable $callback = null, $options = [])
 */
class TPlaceTable extends Table
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

        $this->setTable('t_place');
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
            ->allowEmpty('ID_PLACE', 'create');

        $validator
            ->scalar('PLACE_NAME')
            ->maxLength('PLACE_NAME', 100)
            ->allowEmpty('PLACE_NAME');

        $validator
            ->requirePresence('ID_COUNTRY', 'create')
            ->notEmpty('ID_COUNTRY');

        $validator
            ->integer('ACTIVE')
            ->allowEmpty('ACTIVE');

        return $validator;
    }
}
