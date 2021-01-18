<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InDepartmentsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InDepartmentsTable Test Case
 */
class InDepartmentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InDepartmentsTable
     */
    protected $InDepartments;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.InDepartments',
        'app.Employees',
        'app.Departments',
        'app.Appointments',
        'app.Documents',
        'app.Schedules',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('InDepartments') ? [] : ['className' => InDepartmentsTable::class];
        $this->InDepartments = $this->getTableLocator()->get('InDepartments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->InDepartments);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
