<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TProvince Entity
 *
 * @property int $ID_PROVINCE
 * @property string $PROVINCE_NAME
 * @property int $ID_COUNTRY
 */
class TProvince extends Entity
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
        'PROVINCE_NAME' => true,
        'ID_COUNTRY' => true
    ];
}
