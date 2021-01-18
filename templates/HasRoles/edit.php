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
            <p class="delete" id="d<?=$hasRole->id?>" >Delete has Role</p>
            <p class="hasRole-link">List has Role</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="hasRoles form content">
            <?= $this->Form->create($hasRole,[
                'id' => '/has-roles/edit/'.$hasRole->id,
                'class' => 'editForm'
            ]) ?>
            <fieldset>
                <legend><?= __('Edit Has Role') ?></legend>
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
        dataActions('.hasRole-link','/has-roles',false);
        dataDeleteAction('/has-roles/delete/', '/has-roles',false);
        editForm('.editForm','/has-roles');
    });
</script>