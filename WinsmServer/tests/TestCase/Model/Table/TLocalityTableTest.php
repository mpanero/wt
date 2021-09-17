<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TLocalityTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TLocalityTable Test Case
 */
class TLocalityTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TLocalityTable
     */
    public $TLocality;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TLocality'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TLocality') ? [] : ['className' => TLocalityTable::class];
        $this->TLocality = TableRegistry::getTableLocator()->get('TLocality', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TLocality);

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
