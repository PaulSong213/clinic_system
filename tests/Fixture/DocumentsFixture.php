<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DocumentsFixture
 */
class DocumentsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'document_internal_path_name' => ['type' => 'string', 'length' => 64, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'document_name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'document_type_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'document_url' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'details' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'patient_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'patient_case_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'appointment_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'in_department_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'time_created' => ['type' => 'timestamp', 'length' => null, 'precision' => null, 'null' => true, 'default' => 'current_timestamp()', 'comment' => ''],
        '_indexes' => [
            'FK_document_type_doc' => ['type' => 'index', 'columns' => ['document_type_id'], 'length' => []],
            'FK_patient_case_id_doc' => ['type' => 'index', 'columns' => ['patient_case_id'], 'length' => []],
            'FK_appointment_id_doc' => ['type' => 'index', 'columns' => ['appointment_id'], 'length' => []],
            'FK_in_department_doc' => ['type' => 'index', 'columns' => ['in_department_id'], 'length' => []],
            'FK_patient_id_doc' => ['type' => 'index', 'columns' => ['patient_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'FK_patient_id_doc' => ['type' => 'foreign', 'columns' => ['patient_id'], 'references' => ['patients', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'FK_patient_case_id_doc' => ['type' => 'foreign', 'columns' => ['patient_case_id'], 'references' => ['patient_cases', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'FK_in_department_doc' => ['type' => 'foreign', 'columns' => ['in_department_id'], 'references' => ['in_departments', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'FK_document_type_doc' => ['type' => 'foreign', 'columns' => ['document_type_id'], 'references' => ['document_types', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'FK_appointment_id_doc' => ['type' => 'foreign', 'columns' => ['appointment_id'], 'references' => ['appointments', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'document_internal_path_name' => 'Lorem ipsum dolor sit amet',
                'document_name' => 'Lorem ipsum dolor sit amet',
                'document_type_id' => 1,
                'document_url' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'details' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'patient_id' => 1,
                'patient_case_id' => 1,
                'appointment_id' => 1,
                'in_department_id' => 1,
                'time_created' => 1606951873,
            ],
        ];
        parent::init();
    }
}
