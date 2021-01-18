<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StatusHistories Model
 *
 * @property \App\Model\Table\AppointmentsTable&\Cake\ORM\Association\BelongsTo $Appointments
 * @property \App\Model\Table\AppointmentStatusTable&\Cake\ORM\Association\BelongsTo $AppointmentStatus
 *
 * @method \App\Model\Entity\StatusHistory newEmptyEntity()
 * @method \App\Model\Entity\StatusHistory newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\StatusHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StatusHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\StatusHistory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\StatusHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StatusHistory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\StatusHistory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StatusHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StatusHistory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\StatusHistory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\StatusHistory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\StatusHistory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class StatusHistoriesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('status_histories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Appointments', [
            'foreignKey' => 'appointment_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('AppointmentStatus', [
            'foreignKey' => 'appointment_status_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->dateTime('status_time')
            ->notEmptyDateTime('status_time');

        $validator
            ->scalar('details')
            ->requirePresence('details', 'create')
            ->notEmptyString('details');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['appointment_id'], 'Appointments'), ['errorField' => 'appointment_id']);
        $rules->add($rules->existsIn(['appointment_status_id'], 'AppointmentStatus'), ['errorField' => 'appointment_status_id']);

        return $rules;
    }
}
