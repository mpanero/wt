<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TUserRolesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TUserRolesTable Test Case
 */
class TUserRolesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TUserRolesTable
     */
    public $TUserRoles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TUserRoles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TUserRoles') ? [] : ['className' => TUserRolesTable::class];
        $this->TUserRoles = TableRegistry::getTableLocator()->get('TUserRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TUserRoles);

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
