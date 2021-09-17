<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TTypesTable Test Case
 */
class TTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TTypesTable
     */
    public $TTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TTypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TTypes') ? [] : ['className' => TTypesTable::class];
        $this->TTypes = TableRegistry::getTableLocator()->get('TTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TTypes);

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
