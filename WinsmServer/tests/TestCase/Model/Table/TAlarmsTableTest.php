<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TAlarmsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TAlarmsTable Test Case
 */
class TAlarmsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TAlarmsTable
     */
    public $TAlarms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TAlarms'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TAlarms') ? [] : ['className' => TAlarmsTable::class];
        $this->TAlarms = TableRegistry::getTableLocator()->get('TAlarms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TAlarms);

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
