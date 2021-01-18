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
            <p class="delete" id="d<?=$appointment->id?>" >Delete Appointment</p>
            <p class="appointment-link">List Appointment</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="appointments form content">
            <?= $this->Form->create($appointment,[
                'id' => '/appointments/edit/'.$appointment->id,
                'class' => 'editForm'
            ]) ?>
            <fieldset>
                <legend><?= __('Edit Appointment') ?></legend>
                <?php
                    echo $this->Form->control('patient_case_id', 
                            ['options' => $patientCases]);
                    echo $this->Form->control('in_department_id', ['options' => $inDepartments]);
                    echo $this->Form->control('time_created');
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
        dataActions('.appointment-link','/appointments',false);
        dataDeleteAction('/appointments/delete/', '/appointments',false);
        editForm('.editForm','/appointments');
    });
</script>