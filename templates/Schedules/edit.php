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
            <p class="delete" id="d<?=$schedule->id?>" >Delete schedule</p>
            <p class="schedule-link">List schedule</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="schedules form content">
            <?= $this->Form->create($schedule,[
                'id' => '/schedules/edit/'.$schedule->id,
                'class' => 'editForm'
            ]) ?>
            <fieldset>
                <legend><?= __('Edit Schedule') ?></legend>
                <?php
                    echo $this->Form->control('in_department_id', ['options' => $inDepartments]);
                    echo $this->Form->control('date');
                    echo $this->Form->control('time_start');
                    echo $this->Form->control('time_end');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        dataActions('.schedule-link','/schedules',false);
        dataDeleteAction('/schedules/delete/', '/schedules',false);
        editForm('.editForm','/schedules');
    });
</script>