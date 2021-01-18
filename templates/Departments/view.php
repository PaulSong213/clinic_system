<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="list" >List Departments</p>
            <p class="add" >Add Department</p>
            <p class="edit" id="e<?=$department->id?>" >Edit Department</p>
            <p class="delete" id="d<?=$department->id?>" >Delete Department</p>
            <?= $this->Form->postLink('')?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="departments view content">
            <h3><?= h($department->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Department Name') ?></th>
                    <td><?= h($department->department_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Clinic') ?></th>
                    <td><?= $department->has('clinic') ? $this->Html->link($department->clinic->id, ['controller' => 'Clinics', 'action' => 'view', $department->clinic->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($department->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related In Departments') ?></h4>
               
                <div class="table-responsive">
                    <table id="relatedinDepartment">
                        <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Employee Id') ?></th>
                            <th><?= __('Department Id') ?></th>
                            <th><?= __('Time From') ?></th>
                            <th><?= __('Time To') ?></th>
                            <th><?= __('Is Active') ?></th>
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
    
    function setRelatedinDepartmentDataTable(){
        var mainContentLink = '/in-department';
        var tableSelector = '#relatedinDepartment';
        var foreignColumn = [];
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
            data: <?= json_encode($department['in_departments']) ?>,
            order: [[ 3, "asc" ],[ 0, "asc" ]],
            columns: [
                    { data: 'id' },
                    { data: 'employee_id' },
                    { data: 'department_id' },
                    { data: 'time_from' },
                    { data: 'time_to' },
                    { data: 'is_active' },
                    
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
        dataActions('.list','/departments',false);
        dataActions('.add','/departments/add',false);
        dataActions('.edit','/departments/edit/');
        dataDeleteAction('/departments/delete/', '/departments',false);
        
        viewZoomAction();
        setRelatedinDepartmentDataTable();
        
    });
</script>