<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Gender $gender
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="list" >List Genders</p>
            <p class="add" >Add Gender</p>
            <p class="edit" id="e<?=$gender->id?>" >Edit Gender</p>
            <p class="delete" id="d<?=$gender->id?>" >Delete Gender</p>
            <?= $this->Form->postLink('')?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="genders view content">
            <h3><?= h($gender->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Gender Title') ?></th>
                    <td><?= h($gender->gender_title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($gender->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Employees') ?></h4>
                
                <div class="table-responsive employees">
                    <table  id="relatedEmployees">
                        <thead>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('First Name') ?></th>
                                <th><?= __('Last Name') ?></th>
                                <th><?= __('Password') ?></th>
                                <th><?= __('Email') ?></th>
                                <th><?= __('Mobile Number') ?></th>
                                <th><?= __('Is Active') ?></th>
                                <th><?= __('Gender Id') ?></th>
                                <th><?= __('Age') ?></th>
                                <th><?= __('Address') ?></th>
                                <th><?= __('Contact Person') ?></th>
                                <th><?= __('Contact Person Number') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                
                        </tbody>
                    </table>
                </div>
               
            </div>
            <div class="related">
                <h4><?= __('Related Patients') ?></h4>
                
                <div class="table-responsive">
                    <table id="relatedPatients">
                        <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('First Name') ?></th>
                            <th><?= __('Last Name') ?></th>
                            <th><?= __('Gender Id') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Age') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('Contact Number') ?></th>
                            <th><?= __('Password') ?></th>
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
    
    function setRelatedEmployeesDataTable(){
        var mainContentLink = '/employees';
        var tableSelector = '#relatedEmployees';
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
            data: <?= json_encode($gender['employees']) ?>,
            order: [[ 2, "asc" ],[ 1, "asc" ]],
            columns: [
                    { data: 'id' },
                    { data: 'first_name' },
                    { data: 'last_name' },
                    { data: 'id' },
                    { data: 'email' },
                    { data: 'mobile_number' },
                    { data: 'is_active' },
                    { data: 'gender_id' },
                    { data: 'age' },
                    { data: 'address' },
                    { data: 'contact_person' },
                    { data: 'contact_person_number' },
                ],
            
            pageLength : tableRowsToShow,
            lengthMenu: [[5, 10, 20,50,100,250, -1], [5, 10, 20,50,100,250, 'All']],
            drawCallback: function( settings ) {
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
    
    function setRelatedPatientsDataTable(){
        var mainContentLink = '/patients';
        var tableSelector = '#relatedPatients';
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
            data: <?= json_encode($gender['patients']) ?>,
            order: [[ 2, "asc" ],[ 1, "asc" ]],
            columns: [
                    { data: 'id' },
                    { data: 'first_name' },
                    { data: 'last_name' },
                    { data: 'gender_id' },
                    { data: 'email' },
                    { data: 'age' },
                    { data: 'address' },
                    { data: 'contact_number' },
                    { data: 'id' },
                ],
            
            pageLength : tableRowsToShow,
            lengthMenu: [[5, 10, 20,50,100,250, -1], [5, 10, 20,50,100,250, 'All']],
            drawCallback: function( settings ) {
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
        dataActions('.list','/genders',false);
        dataActions('.add','/genders/add',false);
        dataActions('.edit','/genders/edit/');
        dataDeleteAction('/genders/delete/', '/genders',false);
        
        viewZoomAction();
        setRelatedEmployeesDataTable();
        setRelatedPatientsDataTable();
       
    });
</script>