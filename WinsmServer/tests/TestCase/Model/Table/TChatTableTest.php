<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TChatTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TChatTable Test Case
 */
class TChatTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TChatTable
     */
    public $TChat;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TChat'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TChat') ? [] : ['className' => TChatTable::class];
        $this->TChat = TableRegistry::getTableLocator()->get('TChat', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TChat);

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
