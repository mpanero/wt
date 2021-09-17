<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TUserFixture
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
        'ID_USER' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'MAIL' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ACTIVE' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'PASSWORD' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'NAME' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'SURNAME' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'COMPANY' => ['type' => 'string', 'length' => 60, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ID_GENDER' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => true, 'default' => '2', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'BIRTHDATE' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'PHONE_MOBILE_COUNTRY' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'PHONE_MOBILE_NUM' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'PHONE_OTHER_COUNTRY' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'PHONE_OTHER_NUM' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_ROL' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => true, 'default' => '2', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_PLACE' => ['type' => 'biginteger', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_LEGAL' => ['type' => 'integer', 'length' => 15, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ACTIVITY' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ID_TYPE_STATUS_USER' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Q1' => ['type' => 'integer', 'length' => 15, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Q2' => ['type' => 'integer', 'length' => 15, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Q3' => ['type' => 'integer', 'length' => 15, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'USER_ADMIN' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'Indica si el usuario es administrador de la empresa o no, caso que si, puede autorizar a vendedores.', 'precision' => null, 'autoIncrement' => null],
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
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'ID_USER' => 1,
                'MAIL' => 'Lorem ipsum dolor sit amet',
                'ACTIVE' => 1,
                'PASSWORD' => 'Lorem ipsum dolor sit amet',
                'NAME' => 'Lorem ipsum dolor sit amet',
                'SURNAME' => 'Lorem ipsum dolor sit amet',
                'COMPANY' => 'Lorem ipsum dolor sit amet',
                'ID_GENDER' => 1,
                'BIRTHDATE' => '2019-11-03',
                'PHONE_MOBILE_COUNTRY' => 1,
                'PHONE_MOBILE_NUM' => 1,
                'PHONE_OTHER_COUNTRY' => 1,
                'PHONE_OTHER_NUM' => 1,
                'ID_ROL' => 1,
                'ID_PLACE' => 1,
                'ID_LEGAL' => 1,
                'ACTIVITY' => 'Lorem ipsum dolor ',
                'ID_TYPE_STATUS_USER' => 1,
                'Q1' => 1,
                'Q2' => 1,
                'Q3' => 1,
                'USER_ADMIN' => 1
            ],
        ];
        parent::init();
    }
}
