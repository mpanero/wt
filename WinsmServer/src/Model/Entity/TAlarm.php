<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TAlarm Entity
 *
 * @property int $ID_ALARM
 * @property int $ID_USER
 * @property int $ID_PRODUCT
 * @property int $ID_TYPE_PRICE
 * @property int $ID_MARKET
 * @property float $PRICE_FROM
 * @property float $PRICE_TO
 * @property int $ACTIVE
 */
class TAlarm extends Entity
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
        'ID_USER' => true,
        'ID_PLACE_PRICE' => true,
        'ID_PRODUCT' => true,
        'ID_TYPE_PRICE' => true,
        'PRICE_FROM' => true,
        'PRICE_TO' => true,
        'ID_CURRENCY' => true,
        'AUT_GENERATION' => true,
        'ACTIVE' => true
    ];
}
