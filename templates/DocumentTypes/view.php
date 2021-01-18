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
            <p class="list" >List Document Types</p>
            <p class="add" >Add Document Type</p>
            <p class="edit" id="e<?=$documentType->id?>" >Edit Document Type</p>
            <p class="delete" id="d<?=$documentType->id?>" >Delete Document Type</p>
            <?= $this->Form->postLink('')?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="documentTypes view content">
            <h3><?= h($documentType->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Type Name') ?></th>
                    <td><?= h($documentType->type_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($documentType->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Documents') ?></h4>
                
                <div class="table-responsive">
                    <table id="relatedDocuments">
                        <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Document Internal Path Name') ?></th>
                            <th><?= __('Document Name') ?></th>
                            <th><?= __('Document Type Id') ?></th>
                            <th><?= __('Document Url') ?></th>
                            <th><?= __('Details') ?></th>
                            <th><?= __('Patient Id') ?></th>
                            <th><?= __('Patient Case Id') ?></th>
                            <th><?= __('Appointment Id') ?></th>
                            <th><?= __('In Department Id') ?></th>
                            <th><?= __('Time Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
               
            </div>
        </div>
    </div>
</div>
<script>
    
    function setRelatedDocumentsDataTable(){
        var mainContentLink = '/documents';
        var tableSelector = '#relatedDocuments';
        var foreignColumn = [];
        var columnHasDate = [11];
        var postLink = '<?= $this->Form->postLink('') ?>';
        var varInForeignArray = 2;
        var tableRowsToShow = "<?php echo (isset($_COOKIE['userPrefferedTableRow'])) ? $_COOKIE['userPrefferedTableRow'] : null ?>";
        var tableForeignCount = foreignColumn.length/varInForeignArray;
        for (var i = 0; i < tableForeignCount; i++) {
            var tableHead = $("<th>Foreign Column</th>");
            tableHead.insertBefore(".actions");
        }
        
        $(tableSelector).DataTable({
            dom: 'Bfrtip',
            buttons: [
                'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
            ], 
            data: <?= json_encode($documentType['documents']) ?>,
            order: [[ 10, "asc" ],[ 0, "asc" ]],
            columns: [
                    { data: 'id' },
                    { data: 'document_internal_path_name' },
                    { data: 'document_name' },
                    { data: 'document_type_id' },
                    { data: 'document_url' },
                    { data: 'details' },
                    { data: 'patient_id' },
                    { data: 'patient_case_id' },
                    { data: 'appointment_id' },
                    { data: 'in_department_id' },
                    { data: 'time_created' },
                ],
            
            pageLength : tableRowsToShow,
            lengthMenu: [[5, 10, 20,50,100,250, -1], [5, 10, 20,50,100,250, 'All']],
            "drawCallback": function( settings ) {
               dataTableForeignActions(tableSelector,columnHasDate,postLink,
                    varInForeignArray,tableForeignCount,foreignColumn, mainContentLink);
                    
            }
        });
        $(".dataTables_length select").attr('style', ' border:none;');
        $(".dataTables_length select").each(function() {
            var option = $(this);
            // Save current value of element
            option.data('oldVal', option.val());
            // Look for changes in the value
            option.bind("propertychange change click keyup input paste", function(event){
               // If value has changed...
               if (option.data('oldVal') !== option.val()) {
                    // Updated stored value
                   option.data('oldVal', option.val());
                   document.cookie = "userPrefferedTableRow="+option.val()+"; expires=Fri, 31 Dec 9999 12:00:00 UTC; path=/";
                }
           });
        });
    }
    
    $(document).ready(function(){
        dataActions('.list','/document-types',false);
        dataActions('.add','/document-types/add',false);
        dataActions('.edit','/document-types/edit/');
        dataDeleteAction('/document-types/delete/', '/document-types',false);
        
        viewZoomAction();
        setRelatedDocumentsDataTable();
    });
</script>