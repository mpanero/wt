<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TTradeFixture
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
        'COD_REF' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ID_USER_OWNER' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_USER_CPART' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'PRICE' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'ID_TP_CURRENCY' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'QT' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'ID_UM' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'CONFIRMED_OWNER' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'CONFIRMED_CPART' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'DH_CREATION' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'ID_TP_STATUS_TRADE' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_TYPE_PRICE' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_PRICE_REF' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'DT_PRICE_FIX_FROM' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'DT_PRICE_FIX_TO' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'ID_CROP' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_TYPE_DELIVERY' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'TYPE_QUALITY' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'QUALITY_INFO' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'ID_REQUEST' => ['type' => 'index', 'columns' => ['ID_REQUEST'], 'length' => []],
            'fk_T_TRADE_T_USEROWNER_idx' => ['type' => 'index', 'columns' => ['ID_USER_OWNER'], 'length' => []],
            'fk_T_TRADE_T_USERCPART_idx' => ['type' => 'index', 'columns' => ['ID_USER_CPART'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ID_TRADE'], 'length' => []],
            'fk_T_TRADE_T_REQUEST1' => ['type' => 'foreign', 'columns' => ['ID_REQUEST'], 'references' => ['t_request', 'ID_REQUEST'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_T_TRADE_T_USERCPART' => ['type' => 'foreign', 'columns' => ['ID_USER_CPART'], 'references' => ['t_user', 'ID_USER'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_T_TRADE_T_USEROWNER' => ['type' => 'foreign', 'columns' => ['ID_USER_OWNER'], 'references' => ['t_user', 'ID_USER'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'ID_TRADE' => 1,
                'ID_REQUEST' => 1,
                'COD_REF' => 'Lorem ipsum dolor ',
                'ID_USER_OWNER' => 1,
                'ID_USER_CPART' => 1,
                'PRICE' => 1.5,
                'ID_TP_CURRENCY' => 1,
                'QT' => 1.5,
                'ID_UM' => 1,
                'CONFIRMED_OWNER' => 1,
                'CONFIRMED_CPART' => 1,
                'DH_CREATION' => '2019-11-03 15:06:50',
                'ID_TP_STATUS_TRADE' => 1,
                'ID_TYPE_PRICE' => 1,
                'ID_PRICE_REF' => 1,
                'DT_PRICE_FIX_FROM' => '2019-11-03 15:06:50',
                'DT_PRICE_FIX_TO' => '2019-11-03 15:06:50',
                'ID_CROP' => 1,
                'ID_TYPE_DELIVERY' => 1,
                'TYPE_QUALITY' => 1,
                'QUALITY_INFO' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
