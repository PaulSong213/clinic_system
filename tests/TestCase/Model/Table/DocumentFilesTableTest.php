<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocumentFilesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocumentFilesTable Test Case
 */
class DocumentFilesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocumentFilesTable
     */
    protected $DocumentFiles;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.DocumentFiles',
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
        $config = $this->getTableLocator()->exists('DocumentFiles') ? [] : ['className' => DocumentFilesTable::class];
        $this->DocumentFiles = $this->getTableLocator()->get('DocumentFiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DocumentFiles);

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
