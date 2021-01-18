<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Patient $patient
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="list" >List Patients</p>
            <p class="add" >Add Patient</p>
            <p class="edit" id="e<?=$patient->id?>" >Edit Patient</p>
            <p class="delete" id="d<?=$patient->id?>" >Delete Patient</p>
            <?= $this->Form->postLink('')?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="patients view content">
            <h3><?= h($patient->id) ?></h3>
            <table>
                
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($patient->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($patient->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gender') ?></th>
                    <td><?= $patient->has('gender') ? $this->Html->link($patient->gender->id, ['controller' => 'Genders', 'action' => 'view', $patient->gender->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($patient->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($patient->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Contact Number') ?></th>
                    <td><?= h($patient->contact_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Password') ?></th>
                    <td><?= h($patient->password) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($patient->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Age') ?></th>
                    <td><?= $this->Number->format($patient->age) ?></td>
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
            <div class="related">
                <h4><?= __('Related Patient Cases') ?></h4>
                
                <div class="table-responsive">
                    <table id="relatedPatientCases">
                        <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Patient Id') ?></th>
                            <th><?= __('Start Time') ?></th>
                            <th><?= __('End Time') ?></th>
                            <th><?= __('In Progress') ?></th>
                            <th><?= __('Total Cost') ?></th>
                            <th><?= __('Amount Paid') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <thead>
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
            data: <?= json_encode($patient['documents']) ?>,
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
    
    function setRelatedPatientCasesDataTable(){
        var mainContentLink = '/patient-cases';
        var tableSelector = '#relatedPatientCases';
        var foreignColumn = [];
        var columnHasDate = [3];
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
            data: <?= json_encode($patient['patient_cases']) ?>,
            order: [[ 2, "asc" ],[ 1, "asc" ]],
            columns: [
                    { data: 'id' },
                    { data: 'patient_id' },
                    { data: 'start_time' },
                    { data: 'end_time' },
                    { data: 'in_progress' },
                    { data: 'total_cost' },
                    { data: 'amount_paid' },
                    
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
        dataActions('.list','/patients',false);
        dataActions('.add','/patients/add',false);
        dataActions('.edit','/patients/edit/');
        dataDeleteAction('/patients/delete/', '/patients',false);
        
        viewZoomAction();
        setRelatedDocumentsDataTable(); 
        setRelatedPatientCasesDataTable();
    });
</script>