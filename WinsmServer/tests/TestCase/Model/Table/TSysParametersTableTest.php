<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TSysParametersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TSysParametersTable Test Case
 */
class TSysParametersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TSysParametersTable
     */
    public $TSysParameters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TSysParameters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TSysParameters') ? [] : ['className' => TSysParametersTable::class];
        $this->TSysParameters = TableRegistry::getTableLocator()->get('TSysParameters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TSysParameters);

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
