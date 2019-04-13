<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TTypeActivitiesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TTypeActivitiesTable Test Case
 */
class TTypeActivitiesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TTypeActivitiesTable
     */
    public $TTypeActivities;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.t_type_activities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TTypeActivities') ? [] : ['className' => TTypeActivitiesTable::class];
        $this->TTypeActivities = TableRegistry::get('TTypeActivities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TTypeActivities);

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
