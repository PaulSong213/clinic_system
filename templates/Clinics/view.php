<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Clinic $clinic
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <p class="list" >List Clinics</p>
            <p class="add" >Add Clinic</p>
            <p class="edit" id="e<?=$clinic->id?>" >Edit Clinic</p>
            <p class="delete" id="d<?=$clinic->id?>" >Delete Clinic</p>
            <?= $this->Form->postLink('')?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="clinics view content">
            <h3><?= h($clinic->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Clinic Name') ?></th>
                    <td><?= h($clinic->clinic_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($clinic->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($clinic->id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Details') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($clinic->details)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Departments') ?></h4>
               
                <div class="table-responsive">
                    <table id="relatedDepartments">
                        <thead>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Department Name') ?></th>
                            <th><?= __('Clinic Id') ?></th>
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
    
    function setRelatedDepartmentsDataTable(){
        var mainContentLink = '/departments';
        var tableSelector = '#relatedDepartments';
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
            data: <?= json_encode($clinic['departments']) ?>,
            order: [[ 1, "asc" ]],
            columns: [
                    { data: 'id' },
                    { data: 'department_name' },
                    { data: 'clinic_id' },
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
        dataActions('.list','/clinics',false);
        dataActions('.add','/clinics/add',false);
        dataActions('.edit','/clinics/edit/');
        dataDeleteAction('/clinics/delete/', '/clinics',false);
        
        viewZoomAction();
        setRelatedDepartmentsDataTable();
    });
</script>