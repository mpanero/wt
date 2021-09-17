<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TRelProdUmTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TRelProdUmTable Test Case
 */
class TRelProdUmTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TRelProdUmTable
     */
    public $TRelProdUm;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TRelProdUm'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TRelProdUm') ? [] : ['className' => TRelProdUmTable::class];
        $this->TRelProdUm = TableRegistry::getTableLocator()->get('TRelProdUm', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TRelProdUm);

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
