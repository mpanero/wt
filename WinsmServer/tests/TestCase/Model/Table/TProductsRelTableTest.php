<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TProductsRelTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TProductsRelTable Test Case
 */
class TProductsRelTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TProductsRelTable
     */
    public $TProductsRel;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TProductsRel'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TProductsRel') ? [] : ['className' => TProductsRelTable::class];
        $this->TProductsRel = TableRegistry::getTableLocator()->get('TProductsRel', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TProductsRel);

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
