<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TCountry Entity
 *
 * @property int $ID_COUNTRY
 * @property string|null $COUNTRY_NAME
 * @property int $ACTIVE
 */
class TCountry extends Entity
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
        'COUNTRY_NAME' => true,
        'ACTIVE' => true
    ];
}
