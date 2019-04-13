<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TChat Model
 *
 * @method \App\Model\Entity\TChat get($primaryKey, $options = [])
 * @method \App\Model\Entity\TChat newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TChat[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TChat|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TChat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TChat[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TChat findOrCreate($search, callable $callback = null, $options = [])
 */
class TChatTable extends Table
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

        $this->setTable('t_chat');
        $this->setDisplayField('ID_CHAT');
        $this->setPrimaryKey('ID_CHAT');

        $this->addBehavior('Timestamp');

        $this->belongsTo('TTrade', [
            'foreignKey' => 'ID_TRADE'
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
            ->allowEmpty('ID_CHAT', 'create');

        $validator
            ->maxLength('COD_REF', 20)
            ->allowEmpty('COD_REF');   

        $validator
            ->requirePresence('ID_TRADE', 'create')
            ->notEmpty('ID_TRADE');

        $validator
            ->integer('ID_USER_ORIGEN')
            ->requirePresence('ID_USER_ORIGEN', 'create')
            ->notEmpty('ID_USER_ORIGEN');

        $validator
            ->integer('ID_USER_DESTINY')
            ->requirePresence('ID_USER_DESTINY', 'create')
            ->notEmpty('ID_USER_DESTINY');

        $validator
            ->maxLength('SMS', 250)
            ->requirePresence('SMS', 'create')
            ->notEmpty('SMS');

        $validator
            ->integer('READ_CHAT')
            ->allowEmpty('READ_CHAT');

        $validator
            ->dateTime('DT_CREATED')
            ->requirePresence('DT_CREATED', 'create')
            ->notEmpty('DT_CREATED');

        return $validator;
    }
}
