<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AppointmentStatus $appointmentStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="list" >List Appointment Status</p>
            <p class="add" >Add Appointment Status</p>
            <p class="edit" id="e<?=$appointmentStatus->id?>" >Edit Appointment Status</p>
            <p class="delete" id="d<?=$appointmentStatus->id?>" >Delete Appointment Status</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="appointmentStatus view content">
            <h3><?= h($appointmentStatus->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Status Name') ?></th>
                    <td><?= h($appointmentStatus->status_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($appointmentStatus->id) ?></td>
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
                <h4><?= __('Related Status Histories') ?></h4>
                
                <div class="table-responsive">
                    <table id="relatedStatusHistories">
                        <thead>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Appointment Id') ?></th>
                                <th><?= __('Appointment Status Id') ?></th>
                                <th><?= __('Status Time') ?></th>
                                <th><?= __('Details') ?></th>
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
            data: <?= json_encode($appointmentStatus['appointments']) ?>,
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
    
    function setRelatedStatusHistoriesDataTable(){
        var mainContentLink = '/status-histories';
        var tableSelector = '#relatedStatusHistories';
        var foreignColumn = [];
        var columnHasDate = [4];
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
            data: <?= json_encode($appointmentStatus['status_histories']) ?>,
            order: [[ 2, "asc" ],[ 1, "asc" ]],
            columns: [
                    { data: 'id' },
                    { data: 'appointment_id' },
                    { data: 'appointment_status_id' },
                    { data: 'status_time' },
                    { data: 'details' },
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
        dataActions('.list','/appointment-status',false);
        dataActions('.add','/appointment-status/add',false);
        dataActions('.edit','/appointment-status/edit/');
        dataDeleteAction('/appointment-status/delete/', '/appointment-status',false);
        viewZoomAction();
        setRelatedAppointmentsDataTable();
        setRelatedStatusHistoriesDataTable();
        
    });
</script>