<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TSysParameter Entity
 *
 * @property int $ID_PARAMETER
 * @property string $NAME_PARAMETER
 * @property string $VALUE_PARAMETER
 */
class TSysParameter extends Entity
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
        'NAME_PARAMETER' => true,
        'VALUE_PARAMETER' => true
    ];
}
