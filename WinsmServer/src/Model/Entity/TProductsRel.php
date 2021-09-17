<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TProductsRel Entity
 *
 * @property int $ID_PRODUCT
 * @property int $ID_PRODUCT_PRICE
 */
class TProductsRel extends Entity
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
        'ID_PRODUCT' => true,
        'ID_PRODUCT_PRICE' => true
    ];
}
