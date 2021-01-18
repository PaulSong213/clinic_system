<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InDepartment[]|\Cake\Collection\CollectionInterface $inDepartments
 */
?>
<div class="inDepartments index content">
    <?= $this->Html->link(__('New In Department'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('In Departments') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('employee_id') ?></th>
                    <th><?= $this->Paginator->sort('department_id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('time_from') ?></th>
                    <th><?= $this->Paginator->sort('time_to') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inDepartments as $inDepartment): ?>
                <tr>
                    <td><?= $this->Number->format($inDepartment->id) ?></td>
                    <td><?= $inDepartment->has('employee') ? 
                    $this->Html->link($inDepartment->employee->full_name, ['controller' => 'Employees', 'action' => 'view', $inDepartment->employee->id]) : '' ?></td>
                    <td><?= $inDepartment->has('department') ? $this->Html->link($inDepartment->department->department_name, ['controller' => 'Departments', 'action' => 'view', $inDepartment->department->id]) : '' ?></td>
                    <td><?= h($inDepartment->title) ?></td>
                    <td><?= h($inDepartment->time_from) ?></td>
                    <td><?= h($inDepartment->time_to) ?></td>
                    <td><?= h($inDepartment->is_active) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $inDepartment->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $inDepartment->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $inDepartment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inDepartment->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
