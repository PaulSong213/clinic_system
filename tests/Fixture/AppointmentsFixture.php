<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AppointmentsFixture
 */
class AppointmentsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'patient_case_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'in_department_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'time_created' => ['type' => 'timestamp', 'length' => null, 'precision' => null, 'null' => false, 'default' => 'current_timestamp()', 'comment' => ''],
        'appointment_start_time' => ['type' => 'timestamp', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        'appointment_end_time' => ['type' => 'timestamp', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        'appointment_status_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_patient_case' => ['type' => 'index', 'columns' => ['patient_case_id'], 'length' => []],
            'FK_in_department' => ['type' => 'index', 'columns' => ['in_department_id'], 'length' => []],
            'FK_appointment_status_main' => ['type' => 'index', 'columns' => ['appointment_status_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'FK_patient_case' => ['type' => 'foreign', 'columns' => ['patient_case_id'], 'references' => ['patient_cases', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'FK_in_department' => ['type' => 'foreign', 'columns' => ['in_department_id'], 'references' => ['in_departments', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'FK_appointment_status_main' => ['type' => 'foreign', 'columns' => ['appointment_status_id'], 'references' => ['appointment_status', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'patient_case_id' => 1,
                'in_department_id' => 1,
                'time_created' => 1606951833,
                'appointment_start_time' => 1606951833,
                'appointment_end_time' => 1606951833,
                'appointment_status_id' => 1,
            ],
        ];
        parent::init();
    }
}
