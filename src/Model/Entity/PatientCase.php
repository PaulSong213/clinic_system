<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PatientCase Entity
 *
 * @property int $id
 * @property int $patient_id
 * @property string $full_name
 * @property \Cake\I18n\FrozenTime $start_time
 * @property \Cake\I18n\FrozenTime|null $end_time
 * @property bool $in_progress
 * @property string|null $total_cost
 * @property string|null $amount_paid
 *
 * @property \App\Model\Entity\Patient $patient
 * @property \App\Model\Entity\Appointment[] $appointments
 * @property \App\Model\Entity\Document[] $documents
 */
class PatientCase extends Entity
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
        'patient_id' => true,
        'full_name' => true,
        'start_time' => true,
        'end_time' => true,
        'in_progress' => true,
        'total_cost' => true,
        'amount_paid' => true,
        'patient' => true,
        'appointments' => true,
        'documents' => true,
    ];
    
    protected function _getFullDetails()
    {
        $GLOBALS['currency'] = '₱';
        return $this->full_name . ' | ' . $this->start_time.
                ' | '.$GLOBALS['currency'].$this->total_cost;
    }
    
    protected function _getFullDetailsWithId()
    {
        $GLOBALS['currency'] = '₱';
        return 'patient case id: '.$this->id. ' | ' .$this->full_name . ' | ' . $this->start_time.
                ' | '.$GLOBALS['currency'].$this->total_cost;
    }
    
}
