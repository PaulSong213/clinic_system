<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepartmentsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepartmentsTable Test Case
 */
class DepartmentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DepartmentsTable
     */
    protected $Departments;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Departments',
        'app.Clinics',
        'app.InDepartments',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Departments') ? [] : ['className' => DepartmentsTable::class];
        $this->Departments = $this->getTableLocator()->get('Departments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Departments);

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
