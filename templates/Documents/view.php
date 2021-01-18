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
            <p class="list" >List Document</p>
            <p class="add" >Add Document</p>
            <p class="edit" id="e<?=$document->id?>" >Edit Document</p>
            <p class="delete" id="d<?=$document->id?>" >Delete Document</p>
            <?= $this->Form->postLink('')?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="documents view content">
            <h3><?= h($document->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Document Internal Path Name') ?></th>
                    <td><?= h($document->document_internal_path_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Document Name') ?></th>
                    <td><?= h($document->document_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Document Type') ?></th>
                    <td><?= $document->has('document_type') ? $this->Html->link($document->document_type->type_name, ['controller' => 'DocumentTypes', 'action' => 'view', $document->document_type->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Patient') ?></th>
                    <td><?= $document->has('patient') ? $this->Html->link($document->patient->full_name, ['controller' => 'Patients', 'action' => 'view', $document->patient->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Patient Case') ?></th>
                    <td><?= $document->has('patient_case') ? $this->Html->link($document->patient_case->full_details, ['controller' => 'PatientCases', 'action' => 'view', $document->patient_case->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Appointment') ?></th>
                    <td><?= $document->has('appointment') ? $this->Html->link($document->appointment->time_created, ['controller' => 'Appointments', 'action' => 'view', $document->appointment->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('In Department') ?></th>
                    <td><?= $document->has('in_department') ? $this->Html->link($document->in_department->title, ['controller' => 'InDepartments', 'action' => 'view', $document->in_department->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($document->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Time Created') ?></th>
                    <td><?= h($document->time_created) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Document URL (external copy)') ?></strong>
                <blockquote class="externalLink">
                    <?= $this->Text->autoParagraph("<a href=' ".$document->document_url."' target='_blank'>".$document->document_url."</a>") ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Details') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($document->details)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Files') ?></strong>
                <blockquote class="grid gap-4  md:grid-cols-2">
                   
                    <?php
                        if($document->has('document_files')):
                            foreach ($document->document_files as $file):
                    ?>
                    
                    <div class="document-files flex rounded-xl shadow-sm border
                         border-blue-300 text-gray-800  p-5 dark:text-gray-300 hover:shadow-xl">
                        <img src="/clinic-document/<?=$file->pathName?>" class="h-32 w-32 rounded-xl shadow-2x1"
                             alt="preview failed" onerror="this.onerror=null;this.src='/document.png';" />
                        <div class="file-info flex-cols p-4 justify-between">
                            <div class="info">
                                <h1 class="foreign" id="<?= DS.'document-files'.DS.'view'.DS.$file->id ?>"><?= $file->name?></h1>
                                <h1><small><?= date_format($file->created_at,"M d, Y  D");?></small></h1>
                            </div>
                            <div class="action flex justify-center">
                                <a href="<?= DS.$file->pathName?>" class="m-2"
                                   download="<?= $file->name?>">Download</a>
                                <a href="<?= DS.$file->pathName?>" class="m-2"
                                   target="_blank">View</a>
                            </div>
                        
                        
                        </div>
                    </div>
                    
                    <?php
                            endforeach;
                        endif;
                    ?>
                   
                    
                </blockquote>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        dataActions('.list','/documents',false);
        dataActions('.add','/documents/add',false);
        dataActions('.edit','/documents/edit/');
        dataDeleteAction('/documents/delete/', '/documents',false);
        
        foreignMainContent('.foreign');
        viewZoomAction();
    });
</script>