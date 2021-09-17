<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TChat Entity
 *
 * @property int $ID_CHAT
 * @property int $ID_TRADE
 * @property string|null $COD_REF
 * @property int $ID_USER_ORIGEN
 * @property int $ID_USER_DESTINY
 * @property string $SMS
 * @property int|null $READ_CHAT
 * @property \Cake\I18n\FrozenTime $DT_CREATED
 * @property int $VERIFIED
 */
class TChat extends Entity
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
        'ID_TRADE' => true,
        'COD_REF' => true,
        'ID_USER_ORIGEN' => true,
        'ID_USER_DESTINY' => true,
        'SMS' => true,
        'READ_CHAT' => true,
        'DT_CREATED' => true,
        'VERIFIED' => true
    ];
}
