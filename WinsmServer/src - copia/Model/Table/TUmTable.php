<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TUm Model
 *
 * @method \App\Model\Entity\TUm get($primaryKey, $options = [])
 * @method \App\Model\Entity\TUm newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TUm[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TUm|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TUm patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TUm[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TUm findOrCreate($search, callable $callback = null, $options = [])
 */
class TUmTable extends Table
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

        $this->setTable('t_um');
        $this->setDisplayField('ID_UM');
        $this->setPrimaryKey('ID_UM');
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
            ->integer('ID_UM')
            ->allowEmpty('ID_UM', 'create');

        $validator
            ->scalar('UM_NAME')
            ->maxLength('UM_NAME', 45)
            ->allowEmpty('UM_NAME');

        $validator
            ->integer('ID_COUNTRY')
            ->allowEmpty('ID_COUNTRY');

        return $validator;
    }
}
