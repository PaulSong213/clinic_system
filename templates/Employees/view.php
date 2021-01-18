<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="list" >List Employees</p>
            <p class="add" >Add Employee</p>
            <p class="edit" id="e<?=$employee->id?>" >Edit Employee</p>
            <p class="delete" id="d<?=$employee->id?>" >Delete Employee</p>
            <?= $this->Form->postLink('')?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="employees view content">
            <h3><?= h($employee->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($employee->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($employee->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Password') ?></th>
                    <td><?= h($employee->password) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($employee->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mobile Number') ?></th>
                    <td><?= h($employee->mobile_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gender') ?></th>
                    <td><?= $employee->has('gender') ? $this->Html->link($employee->gender->gender_title, ['controller' => 'Genders', 'action' => 'view', $employee->gender->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($employee->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Contact Person') ?></th>
                    <td><?= h($employee->contact_person) ?></td>
                </tr>
                <tr>
                    <th><?= __('Contact Person Number') ?></th>
                    <td><?= h($employee->contact_person_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($employee->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Age') ?></th>
                    <td><?= $this->Number->format($employee->age) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Active') ?></th>
                    <td><?= $this->DataBoolean->setAlternativeBoolean($employee->is_active)?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Has Roles') ?></h4>
                
                <div class="table-responsive">
                    <table id="relatedhasRole">
                        <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Employee Id') ?></th>
                            <th><?= __('Role Id') ?></th>
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
    
    function setRelatedhasRolesDataTable(){
        var mainContentLink = '/has-roles';
        var tableSelector = '#relatedhasRole';
        var foreignColumn = [4,5];
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
            data: <?= json_encode($employee['has_roles']) ?>,
            order: [[ 3, "asc" ],[ 0, "asc" ]],
            columns: [
                    { data: 'id' },
                    { data: 'employee_id' },
                    { data: 'role_id' },
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
            data: <?= json_encode($employee['in_departments']) ?>,
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
        dataActions('.list','/employees',false);
        dataActions('.add','/employees/add',false);
        dataActions('.edit','/employees/edit/');
        dataDeleteAction('/employees/delete/', '/employees',false);
        
        viewZoomAction();
        setRelatedhasRolesDataTable();
        setRelatedinDepartmentDataTable();
    });
</script>