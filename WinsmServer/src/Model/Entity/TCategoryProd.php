<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TCategoryProd Entity
 *
 * @property int $ID_CATEGORY_PROD
 * @property string $CATEGORY_PROD_NAME
 * @property int $ID_MARKET
 * @property int $ACTIVE
 */
class TCategoryProd extends Entity
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
        'CATEGORY_PROD_NAME' => true,
        'ID_MARKET' => true,
        'ACTIVE' => true
    ];
}
