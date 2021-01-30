<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HasRole $hasRole
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="hasRoles-link">List Employee the has Roles</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="hasRoles form content">
            <?= $this->Form->create($hasRole,[
                 'id' => 'mainAddForm',
            ]) ?>
            <fieldset>
                <legend><?= __('Add Has Role') ?></legend>
                <?php
                    echo $this->Form->control('employee_id', ['options' => $employees]);
                    echo $this->Form->control('role_id', ['options' => $roles]);
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
        addForm('/has-roles/add','/has-roles');
        dataActions('.hasRoles-link','/has-roles',false);
    });
</script>