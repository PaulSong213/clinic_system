<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocumentType[]|\Cake\Collection\CollectionInterface $documentTypes
 */
?>
<div class="documentTypes index content">
    <p class="addNew">New Employee</p>
    <h3><?= __('Document Types') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('type_name') ?></th>
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
        
        var mainContentLink = '/document-types';
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
            data: <?= json_encode($documentTypes) ?>,
            order: [[ 0, "asc" ]],
            columns: [
                    { data: 'id' },
                    { data: 'type_name' },
                    
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
        dataActions('.addNew','/document-types/add',false);
        
    });
</script>