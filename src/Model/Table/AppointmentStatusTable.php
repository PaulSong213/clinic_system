<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AppointmentStatus Model
 *
 * @property \App\Model\Table\AppointmentsTable&\Cake\ORM\Association\HasMany $Appointments
 * @property \App\Model\Table\StatusHistoriesTable&\Cake\ORM\Association\HasMany $StatusHistories
 *
 * @method \App\Model\Entity\AppointmentStatus newEmptyEntity()
 * @method \App\Model\Entity\AppointmentStatus newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AppointmentStatus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AppointmentStatus get($primaryKey, $options = [])
 * @method \App\Model\Entity\AppointmentStatus findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AppointmentStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AppointmentStatus[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AppointmentStatus|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AppointmentStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AppointmentStatus[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AppointmentStatus[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AppointmentStatus[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AppointmentStatus[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AppointmentStatusTable extends Table
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

        $this->setTable('appointment_status');
        $this->setDisplayField('status_name');
        $this->setPrimaryKey('id');

        $this->hasMany('Appointments', [
            'foreignKey' => 'appointment_status_id',
        ]);
        $this->hasMany('StatusHistories', [
            'foreignKey' => 'appointment_status_id',
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
            ->scalar('status_name')
            ->maxLength('status_name', 64)
            ->requirePresence('status_name', 'create')
            ->notEmptyString('status_name');
        $validator
            ->scalar('status_color')
            ->maxLength('status_color', 16)
            ->requirePresence('status_color', 'create')
            ->notEmptyString('status_color');

        return $validator;
    }
}
