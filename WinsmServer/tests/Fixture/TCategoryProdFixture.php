<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TCategoryProdFixture
 *
 */
class TCategoryProdFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 't_category_prod';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID_CATEGORY_PROD' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'CATEGORY_PROD_NAME' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ID_MARKET' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ACTIVE' => ['type' => 'integer', 'length' => 1, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_T_CATEGORY_PROD_T_MARKET1_idx' => ['type' => 'index', 'columns' => ['ID_MARKET'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ID_CATEGORY_PROD'], 'length' => []],
            'fk_T_CATEGORY_PROD_T_MARKET1' => ['type' => 'foreign', 'columns' => ['ID_MARKET'], 'references' => ['t_market', 'ID_MARKET'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'ID_CATEGORY_PROD' => 1,
            'CATEGORY_PROD_NAME' => 'Lorem ipsum dolor sit amet',
            'ID_MARKET' => 1,
            'ACTIVE' => 1
        ],
    ];
}
