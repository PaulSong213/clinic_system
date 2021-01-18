<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment[]|\Cake\Collection\CollectionInterface $appointments
 */

?>

<div class="appointments index content">
   <p class="addNew">New Appointment</p>
    <h3><?= __('Appointments') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('patient_case_id') ?></th>
                    <th><?= $this->Paginator->sort('in_department_id') ?></th>
                    <th><?= $this->Paginator->sort('time_created') ?></th>
                    <th><?= $this->Paginator->sort('appointment_start_time') ?></th>
                    <th><?= $this->Paginator->sort('appointment_end_time') ?></th>
                    <th><?= $this->Paginator->sort('appointment_status_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
              
            </tbody>
        </table>
    </div>
</div>
<script>
   
    function setDataTable(){
        var mainContentLink = '/appointments';
        var tableSelector = '.table-responsive table';
        var foreignColumn = [2,"/patient-cases/view/",3,"/in-departments/view/",7,"/appointment-status/view/"];
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
            
            data: <?= json_encode($appointments) ?>,
            order: [[ 4, "asc" ],[ 3, 'asc' ]],
            columns: [
                    { data: 'id' },
                    { data: 'patient_case.full_name', className: "foreign", targets: "_all" },
                    { data: 'in_department.title', className: "foreign", targets: "_all" },
                    { data: 'time_created' },
                    { data: 'appointment_start_time' },
                    { data: 'appointment_end_time' },
                    { data: 'appointment_status.status_name', className: "foreign", targets: "_all"},
                    { data: 'patient_case_id' , className: "hidden", targets: "_all"},
                    { data: 'in_department_id' , className: "hidden", targets: "_all"},
                    { data: 'appointment_status_id' , className: "hidden", targets: "_all"},
                ],
            
            pageLength : tableRowsToShow,
            lengthMenu: [[5, 10, 20,50,100,250, -1], [5, 10, 20,50,100,250, 'All']],
            "drawCallback": function( settings ) {
                dataTableForeignActions(tableSelector,columnHasDate,postLink,
                    varInForeignArray,tableForeignCount,foreignColumn, mainContentLink);
                    
            },
            dom: 'Bfrtip',
            buttons: [
                'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
            ],        
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
        scrollToAction();
        setDataTable();
        dataActions('.addNew','/appointments/add',false);
    });
</script>