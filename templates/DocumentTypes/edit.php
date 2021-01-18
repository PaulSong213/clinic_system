<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocumentType $documentType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="delete" id="d<?=$documentType->id?>" >Delete Document Type</p>
            <p class="documentType-link">List Document Types</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="documentTypes form content">
            <?= $this->Form->create($documentType,[
                 'id' => '/document-types/edit/'.$documentType->id,
                'class' => 'editForm'
            ]) ?>
            <fieldset>
                <legend><?= __('Edit Document Type') ?></legend>
                <?php
                    echo $this->Form->control('type_name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        dataActions('.documentType-link','/document-types',false);
        dataDeleteAction('/document-types/delete/', '/document-types',false);
        editForm('.editForm','/document-types');
    });
</script>