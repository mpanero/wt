<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TRequestTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TRequestTable Test Case
 */
class TRequestTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TRequestTable
     */
    public $TRequest;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.t_request',
        'app.t_market',
        'app.t_product',
        'app.t_place',
        'app.t_user',
        'app.t_um',
        'app.t_currency',
        'app.t_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TRequest') ? [] : ['className' => TRequestTable::class];
        $this->TRequest = TableRegistry::get('TRequest', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TRequest);

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

    /**
     * Test beforeSave method
     *
     * @return void
     */
    public function testBeforeSave()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
