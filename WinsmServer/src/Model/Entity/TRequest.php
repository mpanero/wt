<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TRequest Entity
 *
 * @property int $ID_REQUEST
 * @property int $ID_USER_OWNER
 * @property \Cake\I18n\FrozenTime|null $DH_REQUEST
 * @property int|null $ID_TP_OPERATION
 * @property int $ID_MARKET
 * @property int|null $ID_TP_BUSINESS
 * @property int $ID_PRODUCT
 * @property int|null $PRICE_FROM
 * @property int|null $PRICE_TO
 * @property int|null $ID_TP_CURRENCY
 * @property int|null $QT_FROM
 * @property int|null $QT_TO
 * @property int|null $ID_UM
 * @property \Cake\I18n\FrozenTime|null $DT_FROM
 * @property \Cake\I18n\FrozenTime|null $DT_TO
 * @property int|null $ID_PLACE_DELIVERY
 * @property int|null $LOC_DISTANCE
 * @property string|null $LOG
 * @property int|null $ID_TP_STATUS_REQ
 * @property \Cake\I18n\FrozenTime|null $DH_LAST_UPDATE
 * @property int $ID_TYPE_PRICE
 * @property int|null $ID_PRICE_REF
 * @property int|null $ID_POSITION
 * @property \Cake\I18n\FrozenTime|null $DT_PRICE_FIX_FROM
 * @property \Cake\I18n\FrozenTime|null $DT_PRICE_FIX_TO
 * @property int|null $ID_CROP
 * @property int|null $ID_TYPE_PAYMENT
 * @property int|null $ID_PLACE_ORIGIN
 * @property int|null $ID_TYPE_DELIVERY
 * @property int|null $DELIVERY_METHOD
 * @property int|null $DELIVERY_AMOUNT
 * @property int|null $TYPE_QUALITY
 * @property string|null $QUALITY_INFO
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
        'LOC_DISTANCE' => true,
        'LOG' => true,
        'ID_TP_STATUS_REQ' => true,
        'DH_LAST_UPDATE' => true,
        'ID_TYPE_PRICE' => true,
        'ID_PRICE_REF' => true,
        'ID_POSITION' => true,
        'DT_PRICE_FIX_FROM' => true,
        'DT_PRICE_FIX_TO' => true,
        'ID_CROP' => true,
        'ID_TYPE_PAYMENT' => true,
        'ID_PLACE_ORIGIN' => true,
        'ID_TYPE_DELIVERY' => true,
        'DELIVERY_METHOD' => true,
        'DELIVERY_AMOUNT' => true,
        'TYPE_QUALITY' => true,
        'QUALITY_INFO' => true,
        'ACTIVE' => true
    ];
}
