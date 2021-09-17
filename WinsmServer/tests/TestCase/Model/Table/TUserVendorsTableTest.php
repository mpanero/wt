<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TUserVendorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TUserVendorsTable Test Case
 */
class TUserVendorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TUserVendorsTable
     */
    public $TUserVendors;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TUserVendors'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TUserVendors') ? [] : ['className' => TUserVendorsTable::class];
        $this->TUserVendors = TableRegistry::getTableLocator()->get('TUserVendors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TUserVendors);

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
