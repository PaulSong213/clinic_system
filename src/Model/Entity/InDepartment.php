<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InDepartment Entity
 *
 * @property int $id
 * @property int $employee_id
 * @property int $department_id
 * @property string $title
 * @property \Cake\I18n\FrozenTime $time_from
 * @property \Cake\I18n\FrozenTime|null $time_to
 * @property bool $is_active
 *
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\Appointment[] $appointments
 * @property \App\Model\Entity\Document[] $documents
 * @property \App\Model\Entity\Schedule[] $schedules
 */
class InDepartment extends Entity
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
        'employee_id' => true,
        'department_id' => true,
        'title' => true,
        'time_from' => true,
        'time_to' => true,
        'is_active' => true,
        'employee' => true,
        'department' => true,
        'appointments' => true,
        'documents' => true,
        'schedules' => true,
    ];
}
