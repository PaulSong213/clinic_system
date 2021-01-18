<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PatientCase $patientCase
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="list" >List Patient Cases</p>
            <p class="add" >Add Patient Case</p>
            <p class="edit" id="e<?=$patientCase->id?>" >Edit Patient Case</p>
            <p class="delete" id="d<?=$patientCase->id?>" >Delete Patient Case</p>
            <?= $this->Form->postLink('')?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="patientCases view content">
            <h3><?= h($patientCase->patient_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Patient') ?></th>
                    <td><?= $patientCase->has('patient') ? $this->Html->link($patientCase->patient->Array, ['controller' => 'Patients', 'action' => 'view', $patientCase->patient->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Full Name') ?></th>
                    <td><?= h($patientCase->full_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($patientCase->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Total Cost') ?></th>
                    <td><?= $this->Number->format($patientCase->total_cost) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount Paid') ?></th>
                    <td><?= $this->Number->format($patientCase->amount_paid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Time') ?></th>
                    <td><?= h($patientCase->start_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Time') ?></th>
                    <td><?= h($patientCase->end_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('In Progress') ?></th>
                    <td><?= $this->DataBoolean->setAlternativeBoolean
                        ($patientCase->in_progress,'In Progress' , 'Stopped')?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Appointments') ?></h4>
                <div class="table-responsive">
                    <table id="relatedAppointments">
                        <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Patient Case Id') ?></th>
                            <th><?= __('In Department Id') ?></th>
                            <th><?= __('Time Created') ?></th>
                            <th><?= __('Appointment Start Time') ?></th>
                            <th><?= __('Appointment End Time') ?></th>
                            <th><?= __('Appointment Status Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
               
            </div>
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
    
    function setRelatedAppointmentsDataTable(){
        var mainContentLink = '/appointments';
        var tableSelector = '#relatedAppointments';
        var foreignColumn = [];
        var columnHasDate = [4,5,6];
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
            data: <?= json_encode($patientCase['appointments']) ?>,
            order: [[ 2, "asc" ],[ 1, "asc" ]],
            columns: [
                    { data: 'id' },
                    { data: 'patient_case_id' },
                    { data: 'in_department_id' },
                    { data: 'time_created' },
                    { data: 'appointment_start_time' },
                    { data: 'appointment_end_time' },
                    { data: 'appointment_status_id' },
                    
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
            data: <?= json_encode($patientCase['documents']) ?>,
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
        dataActions('.list','/patient-cases',false);
        dataActions('.add','/patient-cases/add',false);
        dataActions('.edit','/patient-cases/edit/');
        dataDeleteAction('/patient-cases/delete/', '/patient-cases',false);
        
        viewZoomAction();
        setRelatedAppointmentsDataTable(); 
        setRelatedDocumentsDataTable();
        
    });
</script>