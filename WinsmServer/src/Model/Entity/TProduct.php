<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TProduct Entity
 *
 * @property int $ID_PRODUCT
 * @property string|null $PRODUCT_NAME
 * @property string|null $ACRONYM
 * @property int $ID_MARKET
 * @property int $ID_CATEGORY_PROD
 * @property string $ICON_PATH
 * @property int|null $ACTIVE
 */
class TProduct extends Entity
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
        'ACRONYM' => true,
        'ID_MARKET' => true,
        'ID_CATEGORY_PROD' => true,
        'ICON_PATH' => true,
        'ACTIVE' => true
    ];
}
