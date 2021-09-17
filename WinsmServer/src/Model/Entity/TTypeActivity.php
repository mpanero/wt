<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TTypeActivity Entity
 *
 * @property int $ID_ACTIVITY
 * @property string $ACTIVITY_NAME
 * @property string|null $ACTIVITY_NAME_EN
 * @property int|null $ACTIVITY_NAME_PO
 */
class TTypeActivity extends Entity
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
        'ID_ACTIVITY' => true,
        'ACTIVITY_NAME' => true,
        'ACTIVITY_NAME_EN' => true,
        'ACTIVITY_NAME_PO' => true
    ];
}
