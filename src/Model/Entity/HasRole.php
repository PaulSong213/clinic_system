<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HasRole Entity
 *
 * @property int $id
 * @property int $employee_id
 * @property int $role_id
 * @property \Cake\I18n\FrozenTime $time_from
 * @property \Cake\I18n\FrozenTime|null $time_to
 * @property bool $is_active
 *
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\Role $role
 */
class HasRole extends Entity
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
        'role_id' => true,
        'time_from' => true,
        'time_to' => true,
        'is_active' => true,
        'employee' => true,
        'role' => true,
    ];
}
