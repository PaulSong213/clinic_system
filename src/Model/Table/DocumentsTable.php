<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Documents Model
 *
 * @property \App\Model\Table\DocumentTypesTable&\Cake\ORM\Association\BelongsTo $DocumentTypes
 * @property \App\Model\Table\PatientsTable&\Cake\ORM\Association\BelongsTo $Patients
 * @property \App\Model\Table\PatientCasesTable&\Cake\ORM\Association\BelongsTo $PatientCases
 * @property \App\Model\Table\AppointmentsTable&\Cake\ORM\Association\BelongsTo $Appointments
 * @property \App\Model\Table\InDepartmentsTable&\Cake\ORM\Association\BelongsTo $InDepartments
 *
 * @method \App\Model\Entity\Document newEmptyEntity()
 * @method \App\Model\Entity\Document newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Document[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Document get($primaryKey, $options = [])
 * @method \App\Model\Entity\Document findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Document patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Document[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Document|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Document saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Document[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Document[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Document[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Document[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DocumentsTable extends Table
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

        $this->setTable('documents');
        $this->setDisplayField('document_name');
        $this->setPrimaryKey('id');

        $this->belongsTo('DocumentTypes', [
            'foreignKey' => 'document_type_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Patients', [
            'foreignKey' => 'patient_id',
        ]);
        $this->belongsTo('PatientCases', [
            'foreignKey' => 'patient_case_id',
        ]);
        $this->belongsTo('Appointments', [
            'foreignKey' => 'appointment_id',
        ]);
        $this->belongsTo('InDepartments', [
            'foreignKey' => 'in_department_id',
        ]);
        $this->hasMany('DocumentFiles');
        
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
            ->scalar('document_internal_path_name')
            ->maxLength('document_internal_path_name', 64)
            ->allowEmptyString('document_url');

        $validator
            ->scalar('document_name')
            ->maxLength('document_name', 255)
            ->requirePresence('document_name', 'create')
            ->notEmptyString('document_name');

        $validator
            ->scalar('document_url')
            ->allowEmptyString('document_url');

        $validator
            ->scalar('details')
            ->allowEmptyString('details');

        $validator
            ->dateTime('time_created')
            ->allowEmptyDateTime('time_created');

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
        $rules->add($rules->existsIn(['document_type_id'], 'DocumentTypes'), ['errorField' => 'document_type_id']);
        $rules->add($rules->existsIn(['patient_id'], 'Patients'), ['errorField' => 'patient_id']);
        $rules->add($rules->existsIn(['patient_case_id'], 'PatientCases'), ['errorField' => 'patient_case_id']);
        $rules->add($rules->existsIn(['appointment_id'], 'Appointments'), ['errorField' => 'appointment_id']);
        $rules->add($rules->existsIn(['in_department_id'], 'InDepartments'), ['errorField' => 'in_department_id']);
        
        return $rules;
    }
}
