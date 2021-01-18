<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StatusHistory[]|\Cake\Collection\CollectionInterface $statusHistories
 */
?>

<div class="statusHistories index content">
    <p class="addNew">New Status history</p>
    <h3><?= __('Status Histories') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('appointment_id') ?></th>
                    <th><?= $this->Paginator->sort('appointment_status_id') ?></th>
                    <th><?= $this->Paginator->sort('status_time') ?></th>
                    <th><?= $this->Paginator->sort('status_details') ?></th>
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
        var mainContentLink = '/status-histories';
        var tableSelector = '.table-responsive table';
        var foreignColumn = [2,"/appointments/view/",3,"/appointment-status/view/",];
        var columnHasDate = [2,4];
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
            data: <?= json_encode($statusHistories) ?>,
            order: [[ 3, "asc" ],[ 0, 'asc' ]],
            columns: [
                    { data: 'id' },
                    { data: 'appointment.time_created', className: "foreign", targets: "_all" },
                    { data: 'appointment_status.status_name', className: "foreign", targets: "_all" },
                    { data: 'status_time' },
                    { data: 'details' },
                    { data: 'appointment_id' , className: "hidden", targets: "_all"},
                    { data: 'appointment_status_id' , className: "hidden", targets: "_all"},
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
        dataActions('.addNew','/status-histories/add',false);
        
    });
</script>