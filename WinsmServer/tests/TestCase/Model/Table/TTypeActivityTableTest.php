<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TTypeActivityTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TTypeActivityTable Test Case
 */
class TTypeActivityTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TTypeActivityTable
     */
    public $TTypeActivity;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.t_type_activity'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TTypeActivity') ? [] : ['className' => TTypeActivityTable::class];
        $this->TTypeActivity = TableRegistry::get('TTypeActivity', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TTypeActivity);

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
