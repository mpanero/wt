<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TCategoryProdTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TCategoryProdTable Test Case
 */
class TCategoryProdTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TCategoryProdTable
     */
    public $TCategoryProd;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TCategoryProd'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TCategoryProd') ? [] : ['className' => TCategoryProdTable::class];
        $this->TCategoryProd = TableRegistry::getTableLocator()->get('TCategoryProd', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TCategoryProd);

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
