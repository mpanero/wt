<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TProvinceTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TProvinceTable Test Case
 */
class TProvinceTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TProvinceTable
     */
    public $TProvince;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TProvince'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TProvince') ? [] : ['className' => TProvinceTable::class];
        $this->TProvince = TableRegistry::getTableLocator()->get('TProvince', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TProvince);

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
