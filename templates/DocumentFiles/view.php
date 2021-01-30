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
            <p class="list" >List Files</p>
            <p class="add" >Add File</p>
            <p class="edit" id="e<?=$documentFile->id?>" >Edit File</p>
            <p class="delete" id="d<?=$documentFile->id?>" >Delete File</p>
            <?= $this->Form->postLink('')?>
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
<script> 

    $(document).ready(function(){
        dataActions('.list','/document-files',false);
        dataActions('.add','/document-files/add',false);
        dataActions('.edit','/document-files/edit/');
        dataDeleteAction('/document-files/delete/', '/document-files',false);
        
    });
</script>
    