<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TMarket Entity
 *
 * @property int $ID_MARKET
 * @property string|null $MARKET_NAME
 * @property int $ID_COUNTRY
 * @property int|null $ACTIVE
 */
class TMarket extends Entity
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
        'MARKET_NAME' => true,
        'ID_COUNTRY' => true,
        'ACTIVE' => true
    ];
}
