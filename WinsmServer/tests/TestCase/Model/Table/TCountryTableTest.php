<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TCountryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TCountryTable Test Case
 */
class TCountryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TCountryTable
     */
    public $TCountry;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.t_country'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TCountry') ? [] : ['className' => TCountryTable::class];
        $this->TCountry = TableRegistry::get('TCountry', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TCountry);

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
