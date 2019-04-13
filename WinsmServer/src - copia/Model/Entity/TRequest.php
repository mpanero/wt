<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TRequest Entity
 *
 * @property int $ID_REQUEST
 * @property int $ID_USER_OWNER
 * @property \Cake\I18n\FrozenTime $DH_REQUEST
 * @property int $ID_TP_OPERATION
 * @property int $ID_MARKET
 * @property int $ID_TP_BUSINESS
 * @property int $ID_PRODUCT
 * @property float $PRICE_FROM
 * @property float $PRICE_TO
 * @property int $ID_TP_CURRENCY
 * @property int $QT_FROM
 * @property int $QT_TO
 * @property int $ID_UM
 * @property \Cake\I18n\FrozenTime $DT_FROM
 * @property \Cake\I18n\FrozenTime $DT_TO
 * @property int $ID_PLACE_DELIVERY
 * @property string $LOG
 * @property int $ID_TP_STATUS_REQ
 * @property int $ACTIVE
 */
class TRequest extends Entity
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
        'ID_USER_OWNER' => true,
        'DH_REQUEST' => true,
        'ID_TP_OPERATION' => true,
        'ID_MARKET' => true,
        'ID_TP_BUSINESS' => true,
        'ID_PRODUCT' => true,
        'PRICE_FROM' => true,
        'PRICE_TO' => true,
        'ID_TP_CURRENCY' => true,
        'QT_FROM' => true,
        'QT_TO' => true,
        'ID_UM' => true,
        'DT_FROM' => true,
        'DT_TO' => true,
        'ID_PLACE_DELIVERY' => true,
        'LOG' => true,
        'ID_TP_STATUS_REQ' => true,
        'DH_LAST_UPDATE' => true,
        'ACTIVE' => true
    ];
}
