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
           <p class="department-link">List Department</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="departments form content">
            <?= $this->Form->create($department,[
                 'id' => 'mainAddForm',
            ]) ?>
            <fieldset>
                <legend><?= __('Add Department') ?></legend>
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
        addForm('/departments/add','/departments');
        dataActions('.department-link','/departments',false);
    });
</script>