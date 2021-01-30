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
             <p class="documentType-link">List Document Types</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="documentTypes form content">
            <?= $this->Form->create($documentType,[
                 'id' => 'mainAddForm',
            ]) ?>
            <fieldset>
                <legend><?= __('Add Document Type') ?></legend>
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
        addForm('/document-types/add','/document-types');
        dataActions('.documentType-link','/document-types',false);
    });
</script>