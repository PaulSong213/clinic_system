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
            <p class="document-link">List Files</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="documentFiles form content">
            <?= $this->Form->create($documentFile,[
                'type' => 'file',
                'enctype' => 'multipart/form-data'
            ]) ?>
            <fieldset>
                <legend><?= __('Add Document File') ?></legend>
                <?php
                    echo $this->Form->control('documentSubmitted',[
                        'type' => 'file',
                        'label' => __('Choose Documents to Upload'),
                        'required' => 'true'
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
        addForm('/document-files/add','/document-files');
        dataActions('.document-link','/document-files',false);
    });
</script>