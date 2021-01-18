<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DocumentFile Entity
 *
 * @property int $id
 * @property string $name
 * @property string $pathName
 * @property \Cake\I18n\FrozenTime $created_at
 * @property int $document_id
 *
 * @property \App\Model\Entity\Document $document
 */
class DocumentFile extends Entity
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
        'name' => true,
        'pathName' => true,
        'created_at' => true,
        'document_id' => true,
        'document' => true,
    ];
}
