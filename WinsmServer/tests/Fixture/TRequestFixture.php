<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TRequestFixture
 *
 */
class TRequestFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 't_request';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID_REQUEST' => ['type' => 'biginteger', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'ID_USER_OWNER' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'DH_REQUEST' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'ID_TP_OPERATION' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_MARKET' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_TP_BUSINESS' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_PRODUCT' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'PRICE_FROM' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'PRICE_TO' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_TP_CURRENCY' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'QT_FROM' => ['type' => 'biginteger', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'QT_TO' => ['type' => 'biginteger', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_UM' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'DT_FROM' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'DT_TO' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'ID_PLACE_DELIVERY' => ['type' => 'biginteger', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'LOC_DISTANCE' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'LOG' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ID_TP_STATUS_REQ' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'DH_LAST_UPDATE' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'ID_TYPE_PRICE' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_PRICE_REF' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'DT_PRICE_FIX_FROM' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'DT_PRICE_FIX_TO' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'ID_CROP' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_TYPE_DELIVERY' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'TYPE_QUALITY' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'QUALITY_INFO' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ACTIVE' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_T_REQUEST_T_USERS_idx' => ['type' => 'index', 'columns' => ['ID_USER_OWNER'], 'length' => []],
            'fk_T_REQUEST_T_MARKET1_idx' => ['type' => 'index', 'columns' => ['ID_MARKET'], 'length' => []],
            'fk_T_REQUEST_T_PRODUCT1_idx' => ['type' => 'index', 'columns' => ['ID_PRODUCT'], 'length' => []],
            'fk_T_REQUEST_T_LOCATION1_idx' => ['type' => 'index', 'columns' => ['ID_PLACE_DELIVERY'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ID_REQUEST'], 'length' => []],
            'fk_T_REQUEST_T_LOCATION1' => ['type' => 'foreign', 'columns' => ['ID_PLACE_DELIVERY'], 'references' => ['t_place', 'ID_PLACE'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_T_REQUEST_T_MARKET1' => ['type' => 'foreign', 'columns' => ['ID_MARKET'], 'references' => ['t_market', 'ID_MARKET'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_T_REQUEST_T_PRODUCT1' => ['type' => 'foreign', 'columns' => ['ID_PRODUCT'], 'references' => ['t_product', 'ID_PRODUCT'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_T_REQUEST_T_USERS' => ['type' => 'foreign', 'columns' => ['ID_USER_OWNER'], 'references' => ['t_user', 'ID_USER'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'ID_REQUEST' => 1,
            'ID_USER_OWNER' => 1,
            'DH_REQUEST' => '2018-05-06 21:41:02',
            'ID_TP_OPERATION' => 1,
            'ID_MARKET' => 1,
            'ID_TP_BUSINESS' => 1,
            'ID_PRODUCT' => 1,
            'PRICE_FROM' => 1,
            'PRICE_TO' => 1,
            'ID_TP_CURRENCY' => 1,
            'QT_FROM' => 1,
            'QT_TO' => 1,
            'ID_UM' => 1,
            'DT_FROM' => '2018-05-06 21:41:02',
            'DT_TO' => '2018-05-06 21:41:02',
            'ID_PLACE_DELIVERY' => 1,
            'LOC_DISTANCE' => 1,
            'LOG' => 'Lorem ipsum dolor sit amet',
            'ID_TP_STATUS_REQ' => 1,
            'DH_LAST_UPDATE' => '2018-05-06 21:41:02',
            'ID_TYPE_PRICE' => 1,
            'ID_PRICE_REF' => 1,
            'DT_PRICE_FIX_FROM' => '2018-05-06 21:41:02',
            'DT_PRICE_FIX_TO' => '2018-05-06 21:41:02',
            'ID_CROP' => 1,
            'ID_TYPE_DELIVERY' => 1,
            'TYPE_QUALITY' => 1,
            'QUALITY_INFO' => 'Lorem ipsum dolor sit amet',
            'ACTIVE' => 1
        ],
    ];
}
