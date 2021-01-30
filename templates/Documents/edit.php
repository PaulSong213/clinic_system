<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Document $document
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="delete" id="d<?=$document->id?>" >Delete document</p>
            <p class="document-link">List document</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="documents form content">
            <?= $this->Form->create($document,[
                 'id' => '/documents/edit/'.$document->id,
                'class' => 'editForm'
            ]) ?>
            <fieldset>
                <legend><?= __('Edit Document') ?></legend>
                <?php
                    echo $this->Form->control('document_internal_path_name',[
                        'type' => 'hidden'
                    ]);
                    echo $this->Form->control('document_name');
                    echo $this->Form->control('document_type_id', ['options' => $documentTypes]);
                    echo $this->Form->control('document_url');
                    echo $this->Form->control('details');
                    echo $this->Form->control('patient_id', ['options' => $patients, 'empty' => true]);
                    echo $this->Form->control('patient_case_id', ['options' => $patientCases, 'empty' => true]);
                    echo $this->Form->control('appointment_id', ['options' => $appointments, 'empty' => true]);
                    echo $this->Form->control('in_department_id', ['options' => $inDepartments, 'empty' => true]);
                    echo $this->Form->control('time_created');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        dataActions('.document-link','/documents',false);
        dataDeleteAction('/documents/delete/', '/documents',false);
        editForm('.editForm','/documents');
    });
</script>