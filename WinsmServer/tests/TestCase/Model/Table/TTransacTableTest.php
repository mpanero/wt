<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TTransacTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TTransacTable Test Case
 */
class TTransacTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TTransacTable
     */
    public $TTransac;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TTransac'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TTransac') ? [] : ['className' => TTransacTable::class];
        $this->TTransac = TableRegistry::getTableLocator()->get('TTransac', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TTransac);

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
