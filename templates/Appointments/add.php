<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment $appointment
 */

?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="appointment-link">List Appointments</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="appointments form content">
            <?= $this->Form->create($appointment) ?>
            <fieldset>
                <legend><?= __('Add Appointment') ?></legend>
                <?php
                    echo $this->Form->control('patient_case_id', ['options' => $patientCases]);
                    echo $this->Form->control('in_department_id', ['options' => $inDepartments]);
                    echo $this->Form->control('time_created',
                            ['class' => 'hasDefaultValue']);
                    echo $this->Form->control('appointment_start_time');
                    echo $this->Form->control('appointment_end_time');
                    echo $this->Form->control('appointment_status_id', ['options' => $appointmentStatus]);
                ?>
            </fieldset>
             <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        addForm('/appointments/add','/appointments');
        dataActions('.appointment-link','/appointments',false);
    });
</script>