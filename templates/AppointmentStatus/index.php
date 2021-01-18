<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AppointmentStatus[]|\Cake\Collection\CollectionInterface $appointmentStatus
 */
?>
<div class="appointmentStatus index content">
    <p class="addNew">New Appointment Status</p>
    <h3><?= __('Appointment Status') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('status_name') ?></th>
                    <th ><?= $this->Paginator->sort('status_color') ?></th>
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
            var mainContentLink = '/appointment-status';
            var tableSelector = '.table-responsive table';
            var foreignColumn = [];
            var columnHasDate = [];
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
                data: <?= json_encode($appointmentStatus) ?>,
                order: [[ 0, "asc" ],[ 1, 'asc' ]],
                columns: [
                        { data: 'id' },
                        { data: 'status_name' },
                        { data: 'status_color' },
                        
                    ],

                pageLength : tableRowsToShow,
                lengthMenu: [[5, 10, 20,50,100,250, -1], [5, 10, 20,50,100,250, 'All']],
                "drawCallback": function( settings ) {
                    dataTableForeignActions(tableSelector,columnHasDate,postLink,
                        varInForeignArray,tableForeignCount,foreignColumn, mainContentLink);
                    
                    $(tableSelector + ' tbody tr td:nth-child(1)').each(function(index, element){
                        var target = index + 1;
                        var colorCell = $(tableSelector + " tbody tr:nth-child("+ target +") td:nth-child(3)");
                        var colorSample = $("<div class='w-8 h-8 rounded-lg'></div>");
                        colorSample.attr('style', "background-color:"+ colorCell.html() );
                        colorCell.append(colorSample);
                    });
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
        dataActions('.addNew','/appointment-status/add',false);
        dataActions('.view','/appointment-status/view/');
        dataActions('.edit','/appointment-status/edit/');
        dataDeleteAction('/appointment-status/delete/', '/appointment-status');
        scrollToAction();
        setDataTable();
    });
</script>