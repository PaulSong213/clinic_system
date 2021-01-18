<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AppointmentStatusTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AppointmentStatusTable Test Case
 */
class AppointmentStatusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AppointmentStatusTable
     */
    protected $AppointmentStatus;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AppointmentStatus',
        'app.Appointments',
        'app.StatusHistories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AppointmentStatus') ? [] : ['className' => AppointmentStatusTable::class];
        $this->AppointmentStatus = $this->getTableLocator()->get('AppointmentStatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AppointmentStatus);

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
}
