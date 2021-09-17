<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TTypeActivityFixture
 */
class TTypeActivityFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 't_type_activity';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID_ACTIVITY' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ACTIVITY_NAME' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ACTIVITY_NAME_EN' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ACTIVITY_NAME_PO' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
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
                'ID_ACTIVITY' => 1,
                'ACTIVITY_NAME' => 'Lorem ipsum dolor sit amet',
                'ACTIVITY_NAME_EN' => 'Lorem ipsum dolor sit amet',
                'ACTIVITY_NAME_PO' => 1
            ],
        ];
        parent::init();
    }
}
