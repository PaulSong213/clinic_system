<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Patient Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property int $gender_id
 * @property string $email
 * @property int $age
 * @property string $address
 * @property string $contact_number
 * @property string $password
 *
 * @property \App\Model\Entity\Gender $gender
 * @property \App\Model\Entity\Document[] $documents
 * @property \App\Model\Entity\PatientCase[] $patient_cases
 */
class Patient extends Entity
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
        'first_name' => true,
        'last_name' => true,
        'gender_id' => true,
        'email' => true,
        'age' => true,
        'address' => true,
        'contact_number' => true,
        'password' => true,
        'gender' => true,
        'documents' => true,
        'patient_cases' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
    
    protected function _getFullName()
    {
        return $this->first_name . '  ' . $this->last_name;
    }
    
    
}
