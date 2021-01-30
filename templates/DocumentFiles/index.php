<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DocumentFile[]|\Cake\Collection\CollectionInterface $documentFiles
 */
?>
<div class="documentFiles index content">
    <p class="addNew">New File</p>
    <h3><?= __('Document Files') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th class="hidden"><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('View File') ?></th>
                    <th><?= $this->Paginator->sort('pathName') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('document_id') ?></th>
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
        var mainContentLink = '/document-files';
        var tableSelector = '.table-responsive table';
        var foreignColumn = [6,"/documents/view/"];
        var columnHasDate = [5];
        var postLink = '<?= $this->Form->postLink('') ?>';
        var varInForeignArray = 2;
        var tableRowsToShow = parseInt('<?php echo (isset($_COOKIE['userPrefferedTableRow'])) ? $_COOKIE['userPrefferedTableRow'] : null ?>');
        var tableForeignCount = foreignColumn.length/varInForeignArray;
        for (var i = 0; i < tableForeignCount; i++) {
            var tableHead = $("<th>Foreign Column</th>");
            tableHead.insertBefore(".actions");
        }
        $.fn.dataTable.ext.errMode = 'none';
        $(tableSelector).DataTable({
            dom: 'Bfrtip',
            
            buttons: [
                'pageLength',
                {
                    extend: 'copy', 
                    exportOptions: {
                        columns: ':visible'
                    },
                },
                {
                    extend: 'csv', 
                    exportOptions: {
                        columns: ':visible'
                    },
                },
                {
                    extend: 'excel', 
                    exportOptions: {
                        columns: ':visible'
                    },
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    },
                },
                {
                    extend:  'print',
                    exportOptions: {
                        columns: ':visible'
                    },
                },
                {
                    extend:  'colvis',
                    columns: ':lt(11)'
                },
            ],  
            data: <?= json_encode($documentFiles) ?>,
            order: [[ 0, "desc" ],[ 1, 'asc' ]],
            columns: [
                    { data: 'id' },
                    { data: 'name', className: "hidden", targets: "_all"},
                    { data: 'pathName' , className: "preview-file", targets: "_all"},
                    { data: 'pathName'},
                    { data: 'created_at' },
                    { data: 'document.document_name' , className: "foreign", targets: "_all"},
                    { data: 'document_id' , className: "hidden", targets: "_all"},
                ],
            columnDefs: [
            {
                "targets": [ 6 ],
                "searchable": false
            }
            ],
            
            pageLength : tableRowsToShow,
            lengthMenu: [[5, 10, 20,50,100,250, -1], [5, 10, 20,50,100,250, 'All']],
            "drawCallback": function( settings ) {
                dataTableForeignActions(tableSelector,columnHasDate,postLink,
                    varInForeignArray,tableForeignCount,foreignColumn, mainContentLink);
                $('th').removeClass('externalLink');    
                $('.externalLink').each(function(){
                    var url = $(this).html();
                    var anchor = $("<a href = '"+url+"' target='_blank'>"+url+"</a>");
                    $(this).html(anchor);
                });
                
                var idColumn = $(tableSelector + ' tbody tr td:nth-child(4)');
                idColumn.each(function(index, element){
                    var target = index + 1;
                    var previewCell = $(tableSelector + " tbody tr:nth-child("+target+") td:nth-child(3) ");
                    var fileName = $(tableSelector + " tbody tr:nth-child("+target+") td:nth-child(2)").html();
                    var source = "/clinic-document/"+$(element).html();
                    var sourceExtension = source.split(".").slice(-1)[0];
                    
                    var openFile = $("<a href=' " + source+ "' target='_blank'></a>");
                    var previewImage = $("<img src= '" + source + "'  >");
                    previewImage.attr('onerror', "this.onerror=null;this.src='document.png';" );
                    openFile.append(previewImage);           
                    previewCell.html(openFile);
                    
                    //download link
                    var currentActionRow = $(tableSelector + " tbody tr:nth-child("+ target +") .actions");
                    var downloadLink = $("<p><a href='"+source+"' target='_blank' download='"+fileName+"'>Download</a></p>");
                    currentActionRow.append(downloadLink);
                    
                });
            }
        });
        $(tableSelector + ' thead tr th').removeClass('preview');
        $(".dataTables_length select").attr('style', ' border:none;');
        $(".buttons-page-length").click(function() {
            $(".button-page-length").click(function(){
                var pageLengthValue = $(this).children('span').html();
                if(pageLengthValue !== "All"){
                    document.cookie = "userPrefferedTableRow="+pageLengthValue+"; expires=Fri, 31 Dec 9999 12:00:00 UTC; path=/";
                }else{
                    document.cookie = "userPrefferedTableRow = -1; expires=Fri, 31 Dec 9999 12:00:00 UTC; path=/";
                }
            });
        });
    }
    
    $(document).ready(function(){
        setDataTable();
        scrollToAction();
        dataActions('.addNew','/document-files/add',false);
    });
</script>