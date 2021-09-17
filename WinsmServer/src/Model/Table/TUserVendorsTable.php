<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TUserVendors Model
 *
 * @method \App\Model\Entity\TUserVendor get($primaryKey, $options = [])
 * @method \App\Model\Entity\TUserVendor newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TUserVendor[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TUserVendor|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TUserVendor saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TUserVendor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TUserVendor[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TUserVendor findOrCreate($search, callable $callback = null, $options = [])
 */
class TUserVendorsTable extends Table
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

        $this->setTable('t_user_vendors');
        $this->setDisplayField('ID_USER');
        $this->setPrimaryKey(['ID_USER', 'MAIL_VENDOR']);
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
            ->integer('ID_USER')
            ->allowEmptyString('ID_USER', null, 'create');

        $validator
            ->scalar('MAIL_VENDOR')
            ->maxLength('MAIL_VENDOR', 50)
            ->allowEmptyString('MAIL_VENDOR', null, 'create');

        return $validator;
    }
}
