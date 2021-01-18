<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClinicsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClinicsTable Test Case
 */
class ClinicsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClinicsTable
     */
    protected $Clinics;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Clinics',
        'app.Departments',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Clinics') ? [] : ['className' => ClinicsTable::class];
        $this->Clinics = $this->getTableLocator()->get('Clinics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Clinics);

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
