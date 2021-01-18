<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Appointment Entity
 *
 * @property int $id
 * @property int $patient_case_id
 * @property int $in_department_id
 * @property \Cake\I18n\FrozenTime $time_created
 * @property \Cake\I18n\FrozenTime|null $appointment_start_time
 * @property \Cake\I18n\FrozenTime|null $appointment_end_time
 * @property int $appointment_status_id
 *
 * @property \App\Model\Entity\PatientCase $patient_case
 * @property \App\Model\Entity\InDepartment $in_department
 * @property \App\Model\Entity\AppointmentStatus $appointment_status
 * @property \App\Model\Entity\Document[] $documents
 * @property \App\Model\Entity\StatusHistory[] $status_histories
 */
class Appointment extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'patient_case_id' => true,
        'in_department_id' => true,
        'time_created' => true,
        'appointment_start_time' => true,
        'appointment_end_time' => true,
        'appointment_status_id' => true,
        'patient_case' => true,
        'in_department' => true,
        'appointment_status' => true,
        'documents' => true,
        'status_histories' => true,
    ];
    
    protected function _getPatientCaseDetails()
    {
        return 'patient case id: '. $this-> patient_case_id.' | created on:'.$this->time_created;
    }
}
