<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="delete" id="d<?=$role->id?>" >Delete role</p>
            <p class="role">List role</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="roles form content">
            <?= $this->Form->create($role,[
                'id' => '/roles/edit/'.$role->id,
                'class' => 'editForm'
            ]) ?>
            <fieldset>
                <legend><?= __('Edit Role') ?></legend>
                <?php
                    echo $this->Form->control('role_name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        dataActions('.role-link','/roles',false);
        dataDeleteAction('/roles/delete/', '/roles',false);
        editForm('.editForm','/roles');
    });
</script>