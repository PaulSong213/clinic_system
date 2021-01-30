<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StatusHistory $statusHistory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="statusHistory-link">List Status Histories</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="statusHistories form content">
            <?= $this->Form->create($statusHistory,[
                 'id' => 'mainAddForm',
            ]) ?>
            <fieldset>
                <legend><?= __('Add Status History') ?></legend>
                <?php
                    echo $this->Form->control('appointment_id', ['options' => $appointments]);
                    echo $this->Form->control('appointment_status_id', ['options' => $appointmentStatus]);
                    echo $this->Form->control('status_time');
                    echo $this->Form->control('details');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        addForm('/status-histories/add','/status-histories');
        dataActions('.statusHistory-link','/status-histories',false);
    });
</script>