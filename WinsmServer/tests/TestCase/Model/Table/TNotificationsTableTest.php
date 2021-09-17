<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TNotificationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TNotificationsTable Test Case
 */
class TNotificationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TNotificationsTable
     */
    public $TNotifications;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TNotifications'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TNotifications') ? [] : ['className' => TNotificationsTable::class];
        $this->TNotifications = TableRegistry::getTableLocator()->get('TNotifications', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TNotifications);

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
