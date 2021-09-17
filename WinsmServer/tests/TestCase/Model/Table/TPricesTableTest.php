<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TPricesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TPricesTable Test Case
 */
class TPricesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TPricesTable
     */
    public $TPrices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TPrices'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TPrices') ? [] : ['className' => TPricesTable::class];
        $this->TPrices = TableRegistry::getTableLocator()->get('TPrices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TPrices);

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
