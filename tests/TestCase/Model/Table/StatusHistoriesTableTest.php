<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StatusHistoriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StatusHistoriesTable Test Case
 */
class StatusHistoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StatusHistoriesTable
     */
    protected $StatusHistories;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.StatusHistories',
        'app.Appointments',
        'app.AppointmentStatus',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('StatusHistories') ? [] : ['className' => StatusHistoriesTable::class];
        $this->StatusHistories = $this->getTableLocator()->get('StatusHistories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->StatusHistories);

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
