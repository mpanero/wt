<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TRelProdTypePriceTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TRelProdTypePriceTable Test Case
 */
class TRelProdTypePriceTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TRelProdTypePriceTable
     */
    public $TRelProdTypePrice;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TRelProdTypePrice'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TRelProdTypePrice') ? [] : ['className' => TRelProdTypePriceTable::class];
        $this->TRelProdTypePrice = TableRegistry::getTableLocator()->get('TRelProdTypePrice', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TRelProdTypePrice);

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
