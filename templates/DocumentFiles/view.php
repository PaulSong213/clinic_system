<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocumentFile $documentFile
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Document File'), ['action' => 'edit', $documentFile->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Document File'), ['action' => 'delete', $documentFile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $documentFile->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Document Files'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Document File'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="documentFiles view content">
            <h3><?= h($documentFile->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($documentFile->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('PathName') ?></th>
                    <td><?= h($documentFile->pathName) ?></td>
                </tr>
                <tr>
                    <th><?= __('Document') ?></th>
                    <td><?= $documentFile->has('document') ? $this->Html->link($documentFile->document->id, ['controller' => 'Documents', 'action' => 'view', $documentFile->document->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($documentFile->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($documentFile->created_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
