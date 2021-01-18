<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PatientCases Model
 *
 * @property \App\Model\Table\PatientsTable&\Cake\ORM\Association\BelongsTo $Patients
 * @property \App\Model\Table\AppointmentsTable&\Cake\ORM\Association\HasMany $Appointments
 * @property \App\Model\Table\DocumentsTable&\Cake\ORM\Association\HasMany $Documents
 *
 * @method \App\Model\Entity\PatientCase newEmptyEntity()
 * @method \App\Model\Entity\PatientCase newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PatientCase[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PatientCase get($primaryKey, $options = [])
 * @method \App\Model\Entity\PatientCase findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PatientCase patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PatientCase[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PatientCase|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PatientCase saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PatientCase[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PatientCase[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PatientCase[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PatientCase[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PatientCasesTable extends Table
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

        $this->setTable('patient_cases');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Patients', [
            'foreignKey' => 'patient_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Appointments', [
            'foreignKey' => 'patient_case_id',
        ]);
        $this->hasMany('Documents', [
            'foreignKey' => 'patient_case_id',
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
            ->dateTime('start_time')
            ->notEmptyDateTime('start_time');

        $validator
            ->dateTime('end_time')
            ->allowEmptyDateTime('end_time');

        $validator
            ->boolean('in_progress')
            ->requirePresence('in_progress', 'create')
            ->notEmptyString('in_progress');

        $validator
            ->decimal('total_cost')
            ->allowEmptyString('total_cost');

        $validator
            ->decimal('amount_paid')
            ->allowEmptyString('amount_paid');

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
        $rules->add($rules->existsIn(['patient_id'], 'Patients'), ['errorField' => 'patient_id']);

        return $rules;
    }
}
