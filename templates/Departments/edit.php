<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="delete" id="d<?=$department->id?>" >Delete Department</p>
            <p class="department-link">List Departments</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="departments form content">
            <?= $this->Form->create($department,[
                'id' => '/departments/edit/'.$department->id,
                'class' => 'editForm'
            ]) ?>
            <fieldset>
                <legend><?= __('Edit Department') ?></legend>
                <?php
                    echo $this->Form->control('department_name');
                    echo $this->Form->control('clinic_id', ['options' => $clinics]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        dataActions('.department-link','departments',false);
        dataDeleteAction('/departments/delete/', '/departments',false);
        editForm('.editForm','/departments');
    });
</script>