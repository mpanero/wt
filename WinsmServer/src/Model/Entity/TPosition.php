<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TPosition Entity
 *
 * @property int $ID_POSITION
 * @property string $POSITION
 * @property \Cake\I18n\FrozenDate $DATE_POSITION
 * @property int $ID_TYPE_PRICE_INFO
 * @property int $ACTIVE
 */
class TPosition extends Entity
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
        'POSITION' => true,
        'DATE_POSITION' => true,
        'ID_TYPE_PRICE_INFO' => true,
        'ACTIVE' => true
    ];
}
