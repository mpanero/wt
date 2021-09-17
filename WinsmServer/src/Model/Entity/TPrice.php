<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TPrice Entity
 *
 * @property int $ID
 * @property int $ID_TYPE_PRICE_INFO
 * @property int $ID_PRODUCT
 * @property \Cake\I18n\FrozenTime $DATE_PRICE
 * @property int $ID_PLACE_PRICE
 * @property float|null $PRICE_VALUE
 * @property int $ID_TYPE_CURRENCY
 * @property float $VAR
 * @property int $ID_POSITION
 * @property \Cake\I18n\FrozenTime $UPDATED
 * @property int $LAST
 */
class TPrice extends Entity
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
        'ID_TYPE_PRICE_INFO' => true,
        'ID_PRODUCT' => true,
        'DATE_PRICE' => true,
        'ID_PLACE_PRICE' => true,
        'PRICE_VALUE' => true,
        'ID_TYPE_CURRENCY' => true,
        'VAR' => true,
        'ID_POSITION' => true,
        'UPDATED' => true,
        'LAST' => true
    ];
}
