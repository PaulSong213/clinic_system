<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Appointments Model
 *
 * @property \App\Model\Table\PatientCasesTable&\Cake\ORM\Association\BelongsTo $PatientCases
 * @property \App\Model\Table\InDepartmentsTable&\Cake\ORM\Association\BelongsTo $InDepartments
 * @property \App\Model\Table\AppointmentStatusTable&\Cake\ORM\Association\BelongsTo $AppointmentStatus
 * @property \App\Model\Table\DocumentsTable&\Cake\ORM\Association\HasMany $Documents
 * @property \App\Model\Table\StatusHistoriesTable&\Cake\ORM\Association\HasMany $StatusHistories
 *
 * @method \App\Model\Entity\Appointment newEmptyEntity()
 * @method \App\Model\Entity\Appointment newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Appointment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Appointment get($primaryKey, $options = [])
 * @method \App\Model\Entity\Appointment findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Appointment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Appointment[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Appointment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Appointment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Appointment[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Appointment[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Appointment[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Appointment[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AppointmentsTable extends Table
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

        $this->setTable('appointments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PatientCases', [
            'foreignKey' => 'patient_case_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('InDepartments', [
            'foreignKey' => 'in_department_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('AppointmentStatus', [
            'foreignKey' => 'appointment_status_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Documents', [
            'foreignKey' => 'appointment_id',
        ]);
        $this->hasMany('StatusHistories', [
            'foreignKey' => 'appointment_id',
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
            ->dateTime('time_created')
            ->notEmptyDateTime('time_created');

        $validator
            ->dateTime('appointment_start_time')
            ->allowEmptyDateTime('appointment_start_time');

        $validator
            ->dateTime('appointment_end_time')
            ->allowEmptyDateTime('appointment_end_time');

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
        $rules->add($rules->existsIn(['patient_case_id'], 'PatientCases'), ['errorField' => 'patient_case_id']);
        $rules->add($rules->existsIn(['in_department_id'], 'InDepartments'), ['errorField' => 'in_department_id']);
        $rules->add($rules->existsIn(['appointment_status_id'], 'AppointmentStatus'), ['errorField' => 'appointment_status_id']);

        return $rules;
    }
}
