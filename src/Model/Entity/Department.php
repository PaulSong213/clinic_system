<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Department Entity
 *
 * @property int $id
 * @property string $department_name
 * @property int $clinic_id
 *
 * @property \App\Model\Entity\Clinic $clinic
 * @property \App\Model\Entity\InDepartment[] $in_departments
 */
class Department extends Entity
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
        'department_name' => true,
        'clinic_id' => true,
        'clinic' => true,
        'in_departments' => true,
    ];
}
