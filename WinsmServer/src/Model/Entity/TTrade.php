<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TTrade Entity
 *
 * @property int $ID_TRADE
 * @property int $ID_REQUEST
 * @property string|null $COD_REF
 * @property int $ID_USER_OWNER
 * @property int $ID_USER_CPART
 * @property float|null $PRICE
 * @property int|null $ID_TP_CURRENCY
 * @property float|null $QT
 * @property int $ID_UM
 * @property int|null $CONFIRMED_OWNER
 * @property int|null $CONFIRMED_CPART
 * @property \Cake\I18n\FrozenTime|null $DH_CREATION
 * @property int|null $ID_TP_STATUS_TRADE
 * @property int|null $ID_TYPE_PRICE
 * @property int|null $ID_PRICE_REF
 * @property \Cake\I18n\FrozenTime|null $DT_PRICE_FIX_FROM
 * @property \Cake\I18n\FrozenTime|null $DT_PRICE_FIX_TO
 * @property int|null $ID_CROP
 * @property int|null $ID_TYPE_DELIVERY
 * @property int|null $TYPE_QUALITY
 * @property string|null $QUALITY_INFO
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
        'COD_REF' => true,
        'ID_USER_OWNER' => true,
        'ID_USER_CPART' => true,
        'PRICE' => true,
        'ID_TP_CURRENCY' => true,
        'QT' => true,
        'ID_UM' => true,
        'CONFIRMED_OWNER' => true,
        'CONFIRMED_CPART' => true,
        'DH_CREATION' => true,
        'ID_TP_STATUS_TRADE' => true,
        'ID_TYPE_PRICE' => true,
        'ID_PRICE_REF' => true,
        'DT_PRICE_FIX_FROM' => true,
        'DT_PRICE_FIX_TO' => true,
        'ID_CROP' => true,
        'ID_TYPE_DELIVERY' => true,
        'TYPE_QUALITY' => true,
        'QUALITY_INFO' => true
    ];
}
