<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TTradeFixture
 *
 */
class TTradeFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 't_trade';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID_TRADE' => ['type' => 'biginteger', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'ID_REQUEST' => ['type' => 'biginteger', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_REQUEST_1' => ['type' => 'biginteger', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_USER' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_USER_1' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'PRICE' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'ID_TP_CURRENCY' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'QT' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'ID_UM' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'CONFIRMED' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'CONFIRMED_1' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'DH_CREATION' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'ID_TP_STATUS_TRADE' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_T_TRADE_T_REQUEST1_idx' => ['type' => 'index', 'columns' => ['ID_REQUEST'], 'length' => []],
            'fk_T_TRADE_T_USER1_idx' => ['type' => 'index', 'columns' => ['ID_USER'], 'length' => []],
            'fk_T_TRADE_T_USER2_idx' => ['type' => 'index', 'columns' => ['ID_USER_1'], 'length' => []],
            'fk_T_TRADE_T_REQUEST2' => ['type' => 'index', 'columns' => ['ID_REQUEST_1'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ID_TRADE'], 'length' => []],
            'ID_REQUEST' => ['type' => 'unique', 'columns' => ['ID_REQUEST', 'ID_REQUEST_1'], 'length' => []],
            'fk_T_TRADE_T_REQUEST1' => ['type' => 'foreign', 'columns' => ['ID_REQUEST'], 'references' => ['t_request', 'ID_REQUEST'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_T_TRADE_T_REQUEST2' => ['type' => 'foreign', 'columns' => ['ID_REQUEST_1'], 'references' => ['t_request', 'ID_REQUEST'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_T_TRADE_T_USER1' => ['type' => 'foreign', 'columns' => ['ID_USER'], 'references' => ['t_user', 'ID_USER'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_T_TRADE_T_USER2' => ['type' => 'foreign', 'columns' => ['ID_USER_1'], 'references' => ['t_user', 'ID_USER'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'ID_TRADE' => 1,
            'ID_REQUEST' => 1,
            'ID_REQUEST_1' => 1,
            'ID_USER' => 1,
            'ID_USER_1' => 1,
            'PRICE' => 1.5,
            'ID_TP_CURRENCY' => 1,
            'QT' => 1.5,
            'ID_UM' => 1,
            'CONFIRMED' => 1,
            'CONFIRMED_1' => 1,
            'DH_CREATION' => '2017-12-24 19:44:21',
            'ID_TP_STATUS_TRADE' => 1
        ],
    ];
}
