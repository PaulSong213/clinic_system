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
            <p class="list" >List Status History</p>
            <p class="add" >Add Status History</p>
            <p class="edit" id="e<?=$statusHistory->id?>" >Edit Status History</p>
            <p class="delete" id="d<?=$statusHistory->id?>" >Delete Status History</p>
            <?= $this->Form->postLink('')?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="statusHistories view content">
            <h3><?= h($statusHistory->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Appointment') ?></th>
                    <td><?= $statusHistory->has('appointment') ? $this->Html->link($statusHistory->appointment->time_created, ['controller' => 'Appointments', 'action' => 'view', $statusHistory->appointment->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Appointment Status') ?></th>
                    <td><?= $statusHistory->has('appointment_status') ? $this->Html->link($statusHistory->appointment_status->status_name, ['controller' => 'AppointmentStatus', 'action' => 'view', $statusHistory->appointment_status->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($statusHistory->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status Time') ?></th>
                    <td><?= h($statusHistory->status_time) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Details') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($statusHistory->details)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        dataActions('.list','/status-histories',false);
        dataActions('.add','/status-histories/add',false);
        dataActions('.edit','/status-histories/edit/');
        dataDeleteAction('/status-histories/delete/', '/status-histories',false);
        
        viewZoomAction();
    });
</script>