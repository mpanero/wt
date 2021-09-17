<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TCurrencyTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TCurrencyTable Test Case
 */
class TCurrencyTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TCurrencyTable
     */
    public $TCurrency;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TCurrency'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TCurrency') ? [] : ['className' => TCurrencyTable::class];
        $this->TCurrency = TableRegistry::getTableLocator()->get('TCurrency', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TCurrency);

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
