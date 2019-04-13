<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Security;

/**
 * TUser Entity
 *
 * @property int $ID_USER
 * @property string $MAIL
 * @property int $ACTIVE
 * @property string $PASSWORD
 * @property string $NAME
 * @property string $SURNAME
 * @property string $GENDER
 * @property \Cake\I18n\FrozenDate $BIRTHDATE
 * @property string $PHONE_MOBILE
 * @property string $PHONE_OTHER
 * @property int $ID_ROL
 * @property int $ID_PLACE
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
        'ID_GENDER' => true,
        'BIRTHDATE' => true,
        'PHONE_MOBILE_COUNTRY' => true,
        'PHONE_MOBILE_NUM' => true,
        'PHONE_OTHER_COUNTRY' => true,
        'PHONE_MOBILE_COUNTRY' => true,
        'PHONE_OTHER_NUM' => true,
        'ID_ROL' => true,
        'ID_PLACE' => true
    ];
    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'PASSWORD'
    ];

    /*protected function _setPassword($password)
    {
    	return Security::hash($password,"sha256",true);
    } */   
}
