<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HasRole[]|\Cake\Collection\CollectionInterface $hasRoles
 */
?>
<div class="hasRoles index content">
   <p class="addNew">New Employee Role</p>
    <h3><?= __('Has Roles') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('employee_id') ?></th>
                    <th><?= $this->Paginator->sort('role_id') ?></th>
                    <th><?= $this->Paginator->sort('time_from') ?></th>
                    <th><?= $this->Paginator->sort('time_to') ?></th>
                    <th><?= $this->Paginator->sort('is_active') ?></th>
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
        var mainContentLink = '/has-roles';
        var tableSelector = '.table-responsive table';
        var foreignColumn = [2,"/employees/view/",3,"/roles/view/"];
        var columnHasDate = [4,5];
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
            data: <?= json_encode($hasRoles) ?>,
            order: [[ 4, "asc" ],[ 3, 'asc' ]],
            columns: [
                    { data: 'id' },
                    { data: 'employee.email', className: "foreign", targets: "_all" },
                    { data: 'role.role_name', className: "foreign", targets: "_all" },
                    { data: 'time_from' },
                    { data: 'time_to' },
                    { data: 'is_active' },
                    { data: 'employee_id' , className: "hidden", targets: "_all"},
                    { data: 'role_id' , className: "hidden", targets: "_all"},
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
        scrollToAction();
        setDataTable();
        dataActions('.addNew','/has-roles/add',false);
    });
</script>