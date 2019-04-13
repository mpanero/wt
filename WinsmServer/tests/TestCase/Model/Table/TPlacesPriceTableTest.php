<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TPlacesPriceTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TPlacesPriceTable Test Case
 */
class TPlacesPriceTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TPlacesPriceTable
     */
    public $TPlacesPrice;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.t_places_price'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TPlacesPrice') ? [] : ['className' => TPlacesPriceTable::class];
        $this->TPlacesPrice = TableRegistry::get('TPlacesPrice', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TPlacesPrice);

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
