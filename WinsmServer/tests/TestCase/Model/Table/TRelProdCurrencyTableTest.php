<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TRelProdCurrencyTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TRelProdCurrencyTable Test Case
 */
class TRelProdCurrencyTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TRelProdCurrencyTable
     */
    public $TRelProdCurrency;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TRelProdCurrency'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TRelProdCurrency') ? [] : ['className' => TRelProdCurrencyTable::class];
        $this->TRelProdCurrency = TableRegistry::getTableLocator()->get('TRelProdCurrency', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TRelProdCurrency);

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
