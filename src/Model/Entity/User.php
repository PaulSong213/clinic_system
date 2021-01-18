<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int $role_id
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property int $gender
 * @property string $address
 * @property string $password
 * @property string $type
 * @property int $externalId
 * @property \Cake\I18n\FrozenTime $createad
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Role $role
 */
class User extends Entity
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
        'role_id' => true,
        'email' => true,
        'first_name' => true,
        'last_name' => true,
        'gender' => true,
        'address' => true,
        'password' => true,
        'type' => true,
        'externalId' => true,
        'createad' => true,
        'modified' => true,
        'role' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
}
