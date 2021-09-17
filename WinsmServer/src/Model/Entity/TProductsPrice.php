<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TProductsPrice Entity
 *
 * @property int $ID_PRODUCT_PRICE
 * @property string $PRODUCT_NAME
 * @property int $ACTIVE
 * @property int $ID_COUNTRY
 * @property int $ORDER_INFO
 */
class TProductsPrice extends Entity
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
        'PRODUCT_NAME' => true,
        'ACTIVE' => true,
        'ID_COUNTRY' => true,
        'ORDER_INFO' => true
    ];
}
