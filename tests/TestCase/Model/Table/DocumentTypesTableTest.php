<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocumentTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocumentTypesTable Test Case
 */
class DocumentTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocumentTypesTable
     */
    protected $DocumentTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocumentTypes',
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
        $config = $this->getTableLocator()->exists('DocumentTypes') ? [] : ['className' => DocumentTypesTable::class];
        $this->DocumentTypes = $this->getTableLocator()->get('DocumentTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DocumentTypes);

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
