<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TPlaceTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TPlaceTable Test Case
 */
class TPlaceTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TPlaceTable
     */
    public $TPlace;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.t_place'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TPlace') ? [] : ['className' => TPlaceTable::class];
        $this->TPlace = TableRegistry::get('TPlace', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TPlace);

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
