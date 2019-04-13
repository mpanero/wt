<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TProductsPriceTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TProductsPriceTable Test Case
 */
class TProductsPriceTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TProductsPriceTable
     */
    public $TProductsPrice;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.t_products_price'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TProductsPrice') ? [] : ['className' => TProductsPriceTable::class];
        $this->TProductsPrice = TableRegistry::get('TProductsPrice', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TProductsPrice);

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
