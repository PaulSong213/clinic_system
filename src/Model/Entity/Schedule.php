<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Schedule Entity
 *
 * @property int $id
 * @property int $in_department_id
 * @property \Cake\I18n\FrozenDate $date
 * @property \Cake\I18n\FrozenTime|null $time_start
 * @property \Cake\I18n\FrozenTime|null $time_end
 *
 * @property \App\Model\Entity\InDepartment $in_department
 */
class Schedule extends Entity
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
        'in_department_id' => true,
        'date' => true,
        'time_start' => true,
        'time_end' => true,
        'in_department' => true,
    ];
}
