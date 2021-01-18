<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PatientCase[]|\Cake\Collection\CollectionInterface $patientCases
 */
?>
<div class="patientCases index content">
    <p class="addNew">New Patient Case</p>
    <h3><?= __('Patient Cases') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('patient_id',"Patient") ?></th>
                    <th><?= $this->Paginator->sort('start_time') ?></th>
                    <th><?= $this->Paginator->sort('end_time') ?></th>
                    <th><?= $this->Paginator->sort('in_progress') ?></th>
                    <th><?= $this->Paginator->sort('total_cost') ?></th>
                    <th><?= $this->Paginator->sort('amount_paid') ?></th>
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
        var mainContentLink = '/patient-cases';
        var tableSelector = '.table-responsive table';
        var foreignColumn = [2,"/patients/view/"];
        var columnHasDate = [3,4];
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
            data: <?= json_encode($patientCases) ?>,
            order: [[ 4, "asc" ],[ 3, 'asc' ]],
            columns: [
                    { data: 'id' },
                    { data: 'patient.email', className: "foreign", targets: "_all" },
                    { data: 'start_time'},
                    { data: 'end_time' },
                    { data: 'in_progress' },
                    { data: 'total_cost' },
                    { data: 'amount_paid'},
                    { data: 'patient_id' , className: "hidden", targets: "_all"},
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
        setDataTable();
        scrollToAction();
        dataActions('.addNew','/patient-cases/add',false);
        
    });
</script>