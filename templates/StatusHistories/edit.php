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
            <p class="delete" id="d<?=$statusHistory->id?>" >Delete status History</p>
            <p class="statusHistory">List status History</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="statusHistories form content">
            <?= $this->Form->create($statusHistory,[
                'id' => '/status-histories/edit/'.$statusHistory->id,
                'class' => 'editForm'
            ]) ?>
            <fieldset>
                <legend><?= __('Edit Status History',[
                    'id' => '/status-histories/edit/'.$statusHistory->id,
                'class' => 'editForm'
                ]) ?></legend>
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
        dataActions('.statusHistory-link','/status-histories',false);
        dataDeleteAction('/status-histories/delete/', '/status-histories',false);
        editForm('.editForm','/status-histories');
    });
</script>