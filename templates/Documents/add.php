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
             <p class="document-link">List Documents</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="documents form content">
            <?= $this->Form->create($document,[
                'type' => 'file',
                'enctype' => 'multipart/form-data'
            ]) ?>
            <fieldset>
                <legend><?= __('Add Document') ?></legend>
                <?php
                    echo $this->Form->control('document_name',[
                        'id' => 'docName'
                    ]);
                    echo $this->Form->control('document_internal_path_name',[
                        'type' => 'hidden',
                        'value' => 'There is an error in this row. Create this row again'
                    ]);
                    
                    echo $this->Form->control('documentSubmitted',[
                        'type' => 'file',
                        'multiple' => 'multiple',
                        'name' => 'documentSubmitted[]',
                        'label' => __('Choose Documents to Upload'),
                        'required' => 'true'
                    ]);
                    
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
        addForm('/documents/add','/documents');
        
        dataActions('.document-link','/documents',false);
        
        $('#docName').on('keypress', function (event) {
            var regex = new RegExp("^[&]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (regex.test(key)) {
               event.preventDefault();
               return false;
            }
        });
    });
</script>