<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TTypePricePlacesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TTypePricePlacesTable Test Case
 */
class TTypePricePlacesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TTypePricePlacesTable
     */
    public $TTypePricePlaces;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.t_type_price_places'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TTypePricePlaces') ? [] : ['className' => TTypePricePlacesTable::class];
        $this->TTypePricePlaces = TableRegistry::get('TTypePricePlaces', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TTypePricePlaces);

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
