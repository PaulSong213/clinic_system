<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schedule $schedule
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="list" >List Schedules</p>
            <p class="add" >Add Schedule</p>
            <p class="edit" id="e<?=$schedule->id?>" >Edit Schedule</p>
            <p class="delete" id="d<?=$schedule->id?>" >Delete Schedule</p>
            <?= $this->Form->postLink('')?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="schedules view content">
            <h3><?= h($schedule->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('In Department') ?></th>
                    <td><?= $schedule->has('in_department') ? $this->Html->link($schedule->in_department->id, ['controller' => 'InDepartments', 'action' => 'view', $schedule->in_department->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($schedule->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($schedule->date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Time Start') ?></th>
                    <td><?= h($schedule->time_start) ?></td>
                </tr>
                <tr>
                    <th><?= __('Time End') ?></th>
                    <td><?= h($schedule->time_end) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        dataActions('.list','/schedules',false);
        dataActions('.add','/schedules/add',false);
        dataActions('.edit','/schedules/edit/');
        dataDeleteAction('/schedules/delete/', '/schedules',false);
        
        viewZoomAction();
    });
</script>