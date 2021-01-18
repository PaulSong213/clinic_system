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
            <p class="list" >List has Roles</p>
            <p class="add" >Add has Role</p>
            <p class="edit" id="e<?=$hasRole->id?>" >Edit has Role</p>
            <p class="delete" id="d<?=$hasRole->id?>" >Delete has Role</p>
            <?= $this->Form->postLink('')?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="hasRoles view content">
            <h3><?= h($hasRole->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Employee') ?></th>
                    <td><?= $hasRole->has('employee') ? $this->Html->link($hasRole->employee->first_name.' '.$hasRole->employee->last_name, ['controller' => 'Employees', 'action' => 'view', $hasRole->employee->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= $hasRole->has('role') ? $this->Html->link($hasRole->role->role_name, ['controller' => 'Roles', 'action' => 'view', $hasRole->role->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($hasRole->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Time From') ?></th>
                    <td><?= h($hasRole->time_from) ?></td>
                </tr>
                <tr>
                    <th><?= __('Time To') ?></th>
                    <td><?= h($hasRole->time_to) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $this->DataBoolean->setAlternativeBoolean($hasRole->is_active)?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        dataActions('.list','/has-roles',false);
        dataActions('.add','/has-roles/add',false);
        dataActions('.edit','/has-roles/edit/');
        dataDeleteAction('/has-roles/delete/', '/has-roles',false);
        
        viewZoomAction();
    });
</script>