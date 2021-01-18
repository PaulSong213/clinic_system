<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InDepartment $inDepartment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="delete" id="d<?=$inDepartment->id?>" >Delete inD epartment</p>
            <p class="inDepartment">List in Department</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="inDepartments form content">
            <?= $this->Form->create($inDepartment,[
                'id' => '/in-departments/edit/'.$inDepartment->id,
                'class' => 'editForm'
            ]) ?>
            <fieldset>
                <legend><?= __('Edit In Department') ?></legend>
                <?php
                    echo $this->Form->control('employee_id', ['options' => $employees]);
                    echo $this->Form->control('department_id', ['options' => $departments]);
                    echo $this->Form->control('title');
                    echo $this->Form->control('time_from');
                    echo $this->Form->control('time_to');
                    echo $this->Form->control('is_active');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        dataActions('.inDepartment-link','/in-departments',false);
        dataDeleteAction('/in-departments/delete/', '/in-departments',false);
        editForm('.editForm','/in-departments');
    });
</script>