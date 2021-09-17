<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TRelProdCurrency Entity
 *
 * @property int $ID_CATEGORY_PROD
 * @property int $ID_CURRENCY
 */
class TRelProdCurrency extends Entity
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
        'ID_CATEGORY_PROD' => true,
        'ID_CURRENCY' => true
    ];
}