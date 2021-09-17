<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TGenderFixture
 */
class TGenderFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 't_gender';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ID_GENDER' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'GENDER_NAME' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => '0', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'GENDER_INI' => ['type' => 'string', 'length' => 3, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'ACTIVE' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ID_GENDER'], 'length' => []],
            'GENDER' => ['type' => 'unique', 'columns' => ['ID_GENDER'], 'length' => []],
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
                'ID_GENDER' => 1,
                'GENDER_NAME' => 'Lorem ipsum dolor sit amet',
                'GENDER_INI' => 'L',
                'ACTIVE' => 1
            ],
        ];
        parent::init();
    }
}
