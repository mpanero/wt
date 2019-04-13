<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TGenderTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TGenderTable Test Case
 */
class TGenderTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TGenderTable
     */
    public $TGender;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.t_gender'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TGender') ? [] : ['className' => TGenderTable::class];
        $this->TGender = TableRegistry::get('TGender', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TGender);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
