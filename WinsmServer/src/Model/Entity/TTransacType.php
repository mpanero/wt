<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TTransacType Entity
 *
 * @property int $ID_TRANSAC_TYPE
 * @property string $TRANSAC_TYPE_NAME
 * @property int $SIGN
 */
class TTransacType extends Entity
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
        'ID_TRANSAC_TYPE' => true,
        'TRANSAC_TYPE_NAME' => true,
        'SIGN' => true
    ];
}
