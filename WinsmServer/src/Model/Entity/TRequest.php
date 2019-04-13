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
 * @property int $PRICE_FROM
 * @property int $PRICE_TO
 * @property int $ID_TP_CURRENCY
 * @property int $QT_FROM
 * @property int $QT_TO
 * @property int $ID_UM
 * @property \Cake\I18n\FrozenTime $DT_FROM
 * @property \Cake\I18n\FrozenTime $DT_TO
 * @property int $ID_PLACE_DELIVERY
 * @property int $LOC_DISTANCE
 * @property string $LOG
 * @property int $ID_TP_STATUS_REQ
 * @property \Cake\I18n\FrozenTime $DH_LAST_UPDATE
 * @property int $ID_TYPE_PRICE
 * @property int $ID_PRICE_REF
 * @property \Cake\I18n\FrozenTime $DT_PRICE_FIX_FROM
 * @property \Cake\I18n\FrozenTime $DT_PRICE_FIX_TO
 * @property int $ID_CROP
 * @property int $ID_TYPE_DELIVERY
 * @property int $TYPE_QUALITY
 * @property string $QUALITY_INFO
 * @property int $ACTIVE
 *
 * @property \App\Model\Entity\TMarket $t_market
 * @property \App\Model\Entity\TProduct $t_product
 * @property \App\Model\Entity\TPlace $t_place
 * @property \App\Model\Entity\TUser $t_user
 * @property \App\Model\Entity\TUm $t_um
 * @property \App\Model\Entity\TCurrency $t_currency
 * @property \App\Model\Entity\TType $t_type
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
        'DT_PRICE_FIX_FROM' => true,
        'DT_PRICE_FIX_TO' => true,
        'ID_CROP' => true,
        'ID_TYPE_PAYMENT' => true,
        'ID_TYPE_DELIVERY' => true,
        'TYPE_QUALITY' => true,
        'QUALITY_INFO' => true,
        'ACTIVE' => true,
        't_market' => true,
        't_product' => true,
        't_place' => true,
        't_user' => true,
        't_um' => true,
        't_currency' => true,
        't_type' => true
    ];
}
