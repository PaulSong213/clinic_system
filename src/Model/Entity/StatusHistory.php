<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StatusHistory Entity
 *
 * @property int $id
 * @property int $appointment_id
 * @property int $appointment_status_id
 * @property \Cake\I18n\FrozenTime $status_time
 * @property string $details
 *
 * @property \App\Model\Entity\Appointment $appointment
 * @property \App\Model\Entity\AppointmentStatus $appointment_status
 */
class StatusHistory extends Entity
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
        'appointment_id' => true,
        'appointment_status_id' => true,
        'status_time' => true,
        'details' => true,
        'appointment' => true,
        'appointment_status' => true,
    ];
}
