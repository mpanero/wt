<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TProfileUserTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TProfileUserTable Test Case
 */
class TProfileUserTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TProfileUserTable
     */
    public $TProfileUser;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TProfileUser'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TProfileUser') ? [] : ['className' => TProfileUserTable::class];
        $this->TProfileUser = TableRegistry::getTableLocator()->get('TProfileUser', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TProfileUser);

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
