<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TUserRole Entity
 *
 * @property int $ID_ROL
 * @property string $DESCRIPTION
 * @property int $ACTIVE
 */
class TUserRole extends Entity
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
        'DESCRIPTION' => true,
        'ACTIVE' => true
    ];
}
