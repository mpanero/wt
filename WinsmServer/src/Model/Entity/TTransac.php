<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TTransac Entity
 *
 * @property int $ID_TRANSAC
 * @property int $ID_USER
 * @property int $ID_REQUEST
 * @property int $ID_TRADE
 * @property int $SEC
 * @property int $ID_TRANSAC_TYPE
 * @property \Cake\I18n\FrozenTime $DH_TRANSAC
 * @property float $VALUE
 * @property string $INFO
 * @property string $COMMENTS
 */
class TTransac extends Entity
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
        'ID_USER' => true,
        'ID_REQUEST' => true,
        'ID_TRADE' => true,
        'SEC' => true,
        'ID_TRANSAC_TYPE' => true,
        'DH_TRANSAC' => true,
        'VALUE' => true,
        'INFO' => true,
        'COMMENTS' => true
    ];
}
