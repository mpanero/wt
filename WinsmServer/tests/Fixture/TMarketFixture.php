<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TMarketFixture
 */
class TMarketFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 't_market';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID_MARKET' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'MARKET_NAME' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ID_COUNTRY' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ACTIVE' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_T_MARKET_T_COUNTRY1_idx' => ['type' => 'index', 'columns' => ['ID_COUNTRY'], 'length' => []],
            'ID_MARKET' => ['type' => 'index', 'columns' => ['ID_MARKET'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ID_MARKET'], 'length' => []],
            'fk_T_MARKET_T_COUNTRY1' => ['type' => 'foreign', 'columns' => ['ID_COUNTRY'], 'references' => ['t_country', 'ID_COUNTRY'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'ID_MARKET' => 1,
                'MARKET_NAME' => 'Lorem ipsum dolor sit amet',
                'ID_COUNTRY' => 1,
                'ACTIVE' => 1
            ],
        ];
        parent::init();
    }
}
