<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TMarketTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TMarketTable Test Case
 */
class TMarketTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TMarketTable
     */
    public $TMarket;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.t_market'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TMarket') ? [] : ['className' => TMarketTable::class];
        $this->TMarket = TableRegistry::get('TMarket', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TMarket);

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
