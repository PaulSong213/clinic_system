<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Document Entity
 *
 * @property int $id
 * @property string $document_internal_path_name
 * @property string $document_name
 * @property int $document_type_id
 * @property string $document_url
 * @property string|null $details
 * @property int|null $patient_id
 * @property int|null $patient_case_id
 * @property int|null $appointment_id
 * @property int|null $in_department_id
 * @property \Cake\I18n\FrozenTime|null $time_created
 *
 * @property \App\Model\Entity\DocumentType $document_type
 * @property \App\Model\Entity\Patient $patient
 * @property \App\Model\Entity\PatientCase $patient_case
 * @property \App\Model\Entity\Appointment $appointment
 * @property \App\Model\Entity\InDepartment $in_department
 */
class Document extends Entity
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
        'document_internal_path_name' => true,
        'document_name' => true,
        'document_type_id' => true,
        'document_url' => true,
        'details' => true,
        'patient_id' => true,
        'patient_case_id' => true,
        'appointment_id' => true,
        'in_department_id' => true,
        'time_created' => true,
        'document_type' => true,
        'patient' => true,
        'patient_case' => true,
        'appointment' => true,
        'in_department' => true,
        'document_files' => true,
    ];
}
