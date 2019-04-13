<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TUserTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TUserTable Test Case
 */
class TUserTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TUserTable
     */
    public $TUser;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.t_user'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TUser') ? [] : ['className' => TUserTable::class];
        $this->TUser = TableRegistry::get('TUser', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TUser);

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
