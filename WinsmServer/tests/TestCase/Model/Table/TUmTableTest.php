<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TUmTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TUmTable Test Case
 */
class TUmTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TUmTable
     */
    public $TUm;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.t_um'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TUm') ? [] : ['className' => TUmTable::class];
        $this->TUm = TableRegistry::get('TUm', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TUm);

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
