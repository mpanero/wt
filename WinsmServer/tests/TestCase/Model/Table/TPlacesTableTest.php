<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TPlacesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TPlacesTable Test Case
 */
class TPlacesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TPlacesTable
     */
    public $TPlaces;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TPlaces'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TPlaces') ? [] : ['className' => TPlacesTable::class];
        $this->TPlaces = TableRegistry::getTableLocator()->get('TPlaces', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TPlaces);

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
