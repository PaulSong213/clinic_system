<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PatientCasesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PatientCasesTable Test Case
 */
class PatientCasesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PatientCasesTable
     */
    protected $PatientCases;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.PatientCases',
        'app.Patients',
        'app.Appointments',
        'app.Documents',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PatientCases') ? [] : ['className' => PatientCasesTable::class];
        $this->PatientCases = $this->getTableLocator()->get('PatientCases', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->PatientCases);

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
