<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TNotification Entity
 *
 * @property int $ID_NOTIF
 * @property int $ID_TYPE_NOTIF
 * @property int $ID_USER
 * @property string $DESCRIPTION
 * @property int $READ
 * @property \Cake\I18n\FrozenTime $DT_CREATED
 */
class TNotification extends Entity
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
        'ID_TYPE_NOTIF' => true,
        'COD_REF' => true,
        'ID_USER' => true,
        'DESCRIPTION' => true,
        'READ_NOTIF' => true,
        'DT_CREATED' => true
    ];
}
