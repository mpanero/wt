<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TProvince Model
 *
 * @method \App\Model\Entity\TProvince get($primaryKey, $options = [])
 * @method \App\Model\Entity\TProvince newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TProvince[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TProvince|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TProvince saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TProvince patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TProvince[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TProvince findOrCreate($search, callable $callback = null, $options = [])
 */
class TProvinceTable extends Table
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

        $this->setTable('t_province');
        $this->setDisplayField('ID_PROVINCE');
        $this->setPrimaryKey('ID_PROVINCE');
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
            ->integer('ID_PROVINCE')
            ->allowEmptyString('ID_PROVINCE', null, 'create');

        $validator
            ->scalar('PROVINCE_NAME')
            ->maxLength('PROVINCE_NAME', 255)
            ->requirePresence('PROVINCE_NAME', 'create')
            ->notEmptyString('PROVINCE_NAME');

        $validator
            ->integer('ID_COUNTRY')
            ->requirePresence('ID_COUNTRY', 'create')
            ->notEmptyString('ID_COUNTRY');

        return $validator;
    }
}
