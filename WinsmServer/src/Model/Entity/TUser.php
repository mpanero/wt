<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TUser Entity
 *
 * @property int $ID_USER
 * @property string|null $MAIL
 * @property int|null $ACTIVE
 * @property string|null $PASSWORD
 * @property string|null $NAME
 * @property string|null $SURNAME
 * @property string|null $COMPANY
 * @property int|null $ID_GENDER
 * @property \Cake\I18n\FrozenDate|null $BIRTHDATE
 * @property int|null $PHONE_MOBILE_COUNTRY
 * @property int $PHONE_MOBILE_NUM
 * @property int|null $PHONE_OTHER_COUNTRY
 * @property int|null $PHONE_OTHER_NUM
 * @property int|null $ID_ROL
 * @property int|null $ID_PLACE
 * @property int|null $ID_LEGAL
 * @property string|null $ACTIVITY
 * @property int|null $ID_TYPE_STATUS_USER
 * @property int|null $Q1
 * @property int|null $Q2
 * @property int|null $Q3
 * @property int|null $USER_ADMIN
 */
class TUser extends Entity
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
        'MAIL' => true,
        'ACTIVE' => true,
        'PASSWORD' => true,
        'NAME' => true,
        'SURNAME' => true,
        'COMPANY' => true,
        'ID_GENDER' => true,
        'BIRTHDATE' => true,
        'PHONE_MOBILE_COUNTRY' => true,
        'PHONE_MOBILE_NUM' => true,
        'PHONE_OTHER_COUNTRY' => true,
        'PHONE_OTHER_NUM' => true,
        'ID_ROL' => true,
        'ID_PLACE' => true,
        'ID_LEGAL' => true,
        'ACTIVITY' => true,
        'ID_TYPE_STATUS_USER' => true,
        'Q1' => true,
        'Q2' => true,
        'Q3' => true,
        'USER_ADMIN' => true
    ];
}
