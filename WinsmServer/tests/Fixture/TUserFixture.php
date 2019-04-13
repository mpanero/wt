<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TUserFixture
 *
 */
class TUserFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 't_user';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID_USER' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'MAIL' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ACTIVE' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'PASSWORD' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'NAME' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'SURNAME' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'GENDER' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => 'M=MALE F=FEMALE O=OTHER', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'BIRTHDATE' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'PHONE_MOBILE' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'PHONE_OTHER' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ID_PLACE' => ['type' => 'biginteger', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_T_USER_T_PLACE1_idx' => ['type' => 'index', 'columns' => ['ID_PLACE'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ID_USER'], 'length' => []],
            'fk_T_USER_T_PLACE1' => ['type' => 'foreign', 'columns' => ['ID_PLACE'], 'references' => ['t_place', 'ID_PLACE'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'ID_USER' => 1,
            'MAIL' => 'Lorem ipsum dolor sit amet',
            'ACTIVE' => 1,
            'PASSWORD' => 'Lorem ipsum dolor ',
            'NAME' => 'Lorem ipsum dolor sit amet',
            'SURNAME' => 'Lorem ipsum dolor sit amet',
            'GENDER' => 'Lorem ipsum dolor sit amet',
            'BIRTHDATE' => '2017-12-24',
            'PHONE_MOBILE' => 'Lorem ipsum dolor sit amet',
            'PHONE_OTHER' => 'Lorem ipsum dolor sit amet',
            'ID_PLACE' => 1
        ],
    ];
}
