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
            <p class="delete" id="d<?=$documentFile->id?>" >Delete File</p>
            <p class="document-link">List Files</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="documentFiles form content">
            <?= $this->Form->create($documentFile,[
                 'id' => '/document-files/edit/'.$documentFile->id,
                'class' => 'editForm',
               
            ]) ?>
            <fieldset>
                <legend><?= __('Edit Document File') ?></legend>
                <?php
                   
                    echo $this->Form->control('name',[
                        'type' => 'hidden'
                    ]);
                    echo $this->Form->control('pathName',[
                        'type' => 'hidden'
                    ]);
                    echo $this->Form->control('created_at');
                    echo $this->Form->control('document_id', ['options' => $documents]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        dataActions('.document-link','/document-files',false);
        dataDeleteAction('/document-files/delete/', '/document-files',false);
        editForm('.editForm','/document-files');
    });
</script>