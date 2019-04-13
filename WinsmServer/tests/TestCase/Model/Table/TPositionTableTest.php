<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TPositionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TPositionTable Test Case
 */
class TPositionTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TPositionTable
     */
    public $TPosition;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.t_position'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TPosition') ? [] : ['className' => TPositionTable::class];
        $this->TPosition = TableRegistry::get('TPosition', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TPosition);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
