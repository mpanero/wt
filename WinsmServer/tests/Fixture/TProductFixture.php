<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TProductFixture
 */
class TProductFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 't_product';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID_PRODUCT' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'PRODUCT_NAME' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ACRONYM' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ID_MARKET' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID_CATEGORY_PROD' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ICON_PATH' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ACTIVE' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'ID_PRODUCT' => ['type' => 'index', 'columns' => ['ID_PRODUCT'], 'length' => []],
            'ID_MARKET' => ['type' => 'index', 'columns' => ['ID_MARKET'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ID_PRODUCT'], 'length' => []],
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
                'ID_PRODUCT' => 1,
                'PRODUCT_NAME' => 'Lorem ipsum dolor sit amet',
                'ACRONYM' => 'Lorem ip',
                'ID_MARKET' => 1,
                'ID_CATEGORY_PROD' => 1,
                'ICON_PATH' => 'Lorem ipsum dolor sit amet',
                'ACTIVE' => 1
            ],
        ];
        parent::init();
    }
}
