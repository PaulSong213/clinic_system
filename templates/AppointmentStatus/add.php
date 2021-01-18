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
            <p class="appointmentStatus-link">List Appointment Status</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="appointmentStatus form content">
            <?= $this->Form->create($appointmentStatus) ?>
            <fieldset>
                <legend><?= __('Add Appointment Status') ?></legend>
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
        addForm('/appointment-status/add','/appointment-status');
        dataActions('.appointmentStatus-link','/appointment-status',false);
    });
</script>