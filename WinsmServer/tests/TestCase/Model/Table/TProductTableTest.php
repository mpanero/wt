<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TProductTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TProductTable Test Case
 */
class TProductTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TProductTable
     */
    public $TProduct;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.t_product'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TProduct') ? [] : ['className' => TProductTable::class];
        $this->TProduct = TableRegistry::get('TProduct', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TProduct);

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
