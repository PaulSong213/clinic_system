<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $email
 * @property string $mobile_number
 * @property bool $is_active
 * @property int $gender_id
 * @property int $age
 * @property string $address
 * @property string|null $contact_person
 * @property string|null $contact_person_number
 *
 * @property \App\Model\Entity\Gender $gender
 * @property \App\Model\Entity\HasRole[] $has_roles
 * @property \App\Model\Entity\InDepartment[] $in_departments
 */
class Employee extends Entity
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
        'password' => true,
        'email' => true,
        'mobile_number' => true,
        'is_active' => true,
        'gender_id' => true,
        'age' => true,
        'address' => true,
        'contact_person' => true,
        'contact_person_number' => true,
        'gender' => true,
        'has_roles' => true,
        'in_departments' => true,
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
    
    protected function _getFullDetails()
    {
        return $this->first_name . '  ' . $this->last_name.' | '.
                $this->email;
    }

    
}
