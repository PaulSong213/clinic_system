<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AppointmentStatus $appointmentStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="delete" id="d<?=$appointmentStatus->id?>" >Delete Appointment Status</p>
            <p class="appointmentStatus-link">List Appointment Status</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="appointmentStatus form content">
            <?= $this->Form->create($appointmentStatus,[
                'id' => '/appointment-status/edit/'.$appointmentStatus->id,
                'class' => 'editForm'
            ]) ?>
            <fieldset>
                <legend><?= __('Edit Appointment Status') ?></legend>
                <?php
                    echo $this->Form->control('status_name');
                    echo $this->Form->control('status_color',[
                        'type' => 'color'
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        dataActions('.appointmentStatus-link','/appointment-status',false);
        dataDeleteAction('/appointment-status/delete/', '/appointment-status',false);
        editForm('.editForm','/appointment-status');
    });
</script>