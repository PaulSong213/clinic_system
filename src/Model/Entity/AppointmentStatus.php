<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AppointmentStatus Entity
 *
 * @property int $id
 * @property string $status_name
 *
 * @property \App\Model\Entity\Appointment[] $appointments
 * @property \App\Model\Entity\StatusHistory[] $status_histories
 */
class AppointmentStatus extends Entity
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
        'status_name' => true,
         'status_color' => true,
        'appointments' => true,
        
        'status_histories' => true,
    ];
    
    protected function _getFullDetails()
    {
        return $this->id. '*' . $this->status_name.'*'.$this->status_color;
    }
    
}
