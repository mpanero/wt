<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TTrade Entity
 *
 * @property int $ID_TRADE
 * @property int $ID_REQUEST
 * @property int $ID_REQUEST_1
 * @property int $ID_USER
 * @property int $ID_USER_1
 * @property float $PRICE
 * @property int $ID_TP_CURRENCY
 * @property float $QT
 * @property int $ID_UM
 * @property int $CONFIRMED
 * @property int $CONFIRMED_1
 * @property \Cake\I18n\FrozenTime $DH_CREATION
 * @property int $ID_TP_STATUS_TRADE
 */
class TTrade extends Entity
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
        'ID_REQUEST' => true,
        'ID_USER_OWNER' => true,
        'ID_USER_CPART' => true,
        'PRICE' => true,
        'ID_TP_CURRENCY' => true,
        'QT' => true,
        'ID_UM' => true,
        'CONFIRMED_OWNER' => true,
        'CONFIRMED_CPART' => true,
        'DH_CREATION' => true,
        'ID_TP_STATUS_TRADE' => true
    ];
}
