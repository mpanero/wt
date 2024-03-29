<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TUm Entity
 *
 * @property int $ID_UM
 * @property string|null $UM_NAME
 * @property int|null $ID_COUNTRY
 */
class TUm extends Entity
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
        'UM_NAME' => true,
        'ID_COUNTRY' => true
    ];
}
