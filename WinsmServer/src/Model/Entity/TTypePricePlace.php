<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TTypePricePlace Entity
 *
 * @property int $ID_TYPE_PRICE_INFO
 * @property int $ID_PLACE_PRICE
 * @property int $ACTIVE
 */
class TTypePricePlace extends Entity
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
        'ID_PLACE_PRICE' => true,
        'ACTIVE' => true
    ];
}
