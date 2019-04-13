<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TTransacTypeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TTransacTypeTable Test Case
 */
class TTransacTypeTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TTransacTypeTable
     */
    public $TTransacType;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.t_transac_type'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TTransacType') ? [] : ['className' => TTransacTypeTable::class];
        $this->TTransacType = TableRegistry::get('TTransacType', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TTransacType);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
