<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\HasRolesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\HasRolesTable Test Case
 */
class HasRolesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\HasRolesTable
     */
    protected $HasRoles;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.HasRoles',
        'app.Employees',
        'app.Roles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('HasRoles') ? [] : ['className' => HasRolesTable::class];
        $this->HasRoles = $this->getTableLocator()->get('HasRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->HasRoles);

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
