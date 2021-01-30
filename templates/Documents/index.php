<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Document[]|\Cake\Collection\CollectionInterface $documents
 */

?>

<div class="documents index content">
   <p class="addNew">New Document</p>
    <h3><?= __('Documents') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('document_name') ?></th>
                    <th><?= $this->Paginator->sort('document_internal_path_name') ?></th>
                    <th><?= __('Files') ?></th>
                    <th><?= $this->Paginator->sort('document_url','Document URL (external copy)') ?></th>
                    <th><?= $this->Paginator->sort('details') ?></th>
                    <th><?= $this->Paginator->sort('document_type_id') ?></th>
                    <th><?= $this->Paginator->sort('patient_id') ?></th>
                    <th><?= $this->Paginator->sort('patient_case_id') ?></th>
                    <th><?= $this->Paginator->sort('appointment_id') ?></th>
                    <th><?= $this->Paginator->sort('in_department_id') ?></th>
                    <th><?= $this->Paginator->sort('time_created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table>
    </div>
    
</div>

<div class="hidden shadow-xl rounded-xl"  id="fileToZipContainer">
    <small><bold id="zipFileCount">0</bold> File/s Selected</small>
    <h2>Choose Files to be Included to Zip</h2>
    <?= $this->Form->postLink('') ?>
    <form id="fileToZipForm">
        <div class="zipAction">
            <input type="button" value="Cancel" id="cancelZip">
<!--         IMPORTANT!! ZIP NAME should be current user id so zip names will not override-->
            <input type='hidden' name='zipName' id="zipName">
            <input type="submit" value="Generate Zip File" id="confirmZip">
        </div>
    </form>
</div>
<script>
    function downloadZip(downloadButton){
        
        var zipFileCancelButton = $('#cancelZip');
        
        $(downloadButton).click(function(){
            
            var zipOptionContainer = $('#fileToZipContainer');
            var zipConfirmButton = $("#confirmZip");
            var zipOptions = $('#fileToZipContainer .toZipDiv');
            var zipFileCounter = $('#zipFileCount');
            
            if(zipOptionContainer.is(":visible")){
                zipOptionContainer.hide('fast',function(){
                    zipOptions.remove();
                    zipConfirmButton.attr('disabled',false);
                });
            }
           var fullInfo = $(this).attr('id').split(">");
           var fileNames = fullInfo[0].split("%");
           var filePathNames = fullInfo[1].split("%");
           var fileZipName = fullInfo[2].split("%");
           var zipForm = $('#fileToZipForm');
           console.log(fileNames);
           for(var i = 0; i < filePathNames.length; i++){
               var fileNameFilePath = filePathNames[i] + "%" + fileNames[i];
               var containerZips = $('<div class="toZipDiv shadow-md hover:shadow-xl"></div>');
               var filePreview = $("<img src='clinic-document/"+filePathNames[i]+"' alt='preview'/>");
               filePreview.attr('onerror', "this.onerror=null;this.src='/document.png'");
               var fileLabel = ("<div class='fileNameContainer'><label for='"+fileNames[i]+"'>"+fileNames[i]+"</label></div>");
               var fileCheck = $("<input type='checkbox' id='"+fileNames[i]+"' value='"+fileNameFilePath+"' checked name='fileNamePath[]'>");
               containerZips.append(filePreview);
               containerZips.append(fileLabel);
               containerZips.append(fileCheck);
               zipForm.prepend(containerZips);
           }
           
           var zipName = $("#zipName").attr('value', fileZipName);
           var maxCount = filePathNames.length;
           var fileCount = filePathNames.length;
           zipFileCounter.html('All');
           $('#fileToZipForm input[type = checkbox]').click(function(){
               if($(this).is(":checked")){
                   fileCount++;
                   if(fileCount >= maxCount){
                       zipFileCounter.html('All');
                   }else{
                       zipFileCounter.html(fileCount);
                   }
               }else{
                   fileCount--;
                   zipFileCounter.html(fileCount);
               }
               
               if(fileCount === 0){
                   zipConfirmButton.attr('disabled',true);
               }else{
                   zipConfirmButton.attr('disabled',false);
               }
           });
           zipOptionContainer.show('fast');
           
        });
        
        zipFileCancelButton.click(function(){
            
            var zipOptionContainer = $('#fileToZipContainer');
            var zipConfirmButton = $("#confirmZip");
            var zipOptions = $('#fileToZipContainer .toZipDiv');
            
            zipOptionContainer.hide('fast',function(){
               zipOptions.remove();
               zipConfirmButton.attr('disabled',false);
            });
        });
        var zipLink = '/documents/download-zip';
        $('#fileToZipForm').on('submit', function (e) {
              var formData = new FormData(this);  
              Swal.fire({
                title: 'Please Wait',
                html: 'Generating Your Zip File',// add html attribute if you want or remove
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading()
                },
            });
              e.preventDefault();
              $.ajax({
                type: 'post',
                url: zipLink,
                data: formData,
                beforeSend: function(request) {
                    request.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function (data) {
                    swal.close();
                    
                    var zipInformation = JSON.parse(data);
                    var zipRoute = zipInformation[0];
                    var zipDisplayName = "DOWNLOAD ["+zipInformation[1]+"]";
                    var zipDownloadName = zipInformation[1];
                    $('#fileToZipContainer').hide('fast',function(){
                        $('#fileToZipContainer .toZipDiv').remove();
                        $("#confirmZip").attr('disabled',false);
                    });
                    
                    Swal.fire({
                     title: 'Zip Created',
                     html: "<div class='zipDownloadContainer'><a href='"+zipRoute+"' class='zipDownload' style='color:#d7dade' download='"+zipDownloadName+"'>"+zipDisplayName+"</a></div>",
                     icon: 'info',
                     width: 'fit-content',
                     padding: '1vw',
                     showConfirmButton: false,
                     showCancelButton: true,
                     cancelButtonText: 'Close Dialog'
                    })
                },
                error: function(){
                    Swal.fire({
                        title: 'Unexpected ocuured. Please try again',
                        html: "Page will reload. Please wait.",
                        icon: 'error'
                    });
                    //location.reload();
                },
                cache: false,
                contentType: false,
                processData: false
              });
            });
        
        
    }
    
    function setDataTable(){
        var mainContentLink = '/documents';
        var tableSelector = '.table-responsive table';
        var foreignColumn = [2,"/document-files/view/",7,"/document-types/view/",8,"/patients/view/",9,"/patient-cases/view/",
            10,"/appointments/view/",11,"/in-departments/view/"];
        var columnHasDate = [10,12];
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
            data: <?= json_encode($documents) ?>,
            order: [[ 0, "desc" ],[ 1, 'asc' ]],
            columns: [
                    { data: 'id' },
                    { data: 'document_name'},
                    { data: 'document_files[%].pathName' , className: "hidden", targets: "_all" },
                    { data: 'document_files[%].name'  , className: "file-foreign", targets: "_all"},
                    { data: 'document_url' , className: "externalLink", targets: "_all"},
                    { data: 'details' },
                    { data: 'document_type.type_name' , className: "foreign", targets: "_all"},
                    { data: 'patient.email'  , className: "foreign", targets: "_all" },
                    { data: 'patient_case.full_name'  , className: "foreign", targets: "_all"},
                    { data: 'appointment.time_created' , className: "foreign", targets: "_all"},
                    { data: 'in_department.title' , className: "foreign", targets: "_all"},
                    { data: 'time_created'},
                    { data: 'document_files[%].id' , className: "hidden", targets: "_all"},
                    { data: 'document_type_id' , className: "hidden", targets: "_all"},
                    { data: 'patient_id' , className: "hidden", targets: "_all"},
                    { data: 'patient_case_id' , className: "hidden", targets: "_all"},
                    { data: 'appointment_id' , className: "hidden", targets: "_all"},
                    { data: 'in_department_id' , className: "hidden", targets: "_all"},
                ],
            columnDefs: [
            {
                "targets": [ 13,14,15,16,17 ],
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
                
                $('th').removeClass('file-foreign');
                $('.file-foreign').each(function(index,element){
                    console.log($(this).html());
                    var target = index + 1;
                    var foreignFileIds = $(tableSelector + " tbody tr:nth-child("+ target +") td:nth-child(13) ").html();
                    var pathName = $(tableSelector + " tbody tr:nth-child("+ target +") td:nth-child(3) ").html();
                    var docName = $(tableSelector + " tbody tr:nth-child("+ target +") td:nth-child(2) ").html();
                    var docPatient = $(tableSelector + " tbody tr:nth-child("+ target +") td:nth-child(8) ").html();
                    var docDepartment = $(tableSelector + " tbody tr:nth-child("+ target +") td:nth-child(11) ").html();
                    var name = $(this).html();
                    var fileID = foreignFileIds.split("%");
                    var fileName = name.split("%");
                    var filePathName = pathName.split("%");
                    var documentInfo = docName + docPatient;
                    var infoToZip = name + ">"+ pathName + ">" + documentInfo;
                    $(this).html("");
                    for(var i = 0; i < fileName.length; i++){
                        var foreignLocation = "/document-files/view/" + fileID[i];
                        var foreignName = fileName[i];
                        var foreignElement = $("<p class='foreign' id='"+foreignLocation+"'>"+foreignName+"</p>");
                        $(this).append(foreignElement);
                    }
                    var actionCell = $(tableSelector + " tbody tr:nth-child("+ target +") td:last-child");
                    var downloadButton = $("<p class='download-zip' id='"+infoToZip+"'>Download</p>");
                    actionCell.append(downloadButton);
                });
                foreignMainContent('.foreign');
                downloadZip('.download-zip');
            }
        });
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
        dataActions('.addNew','/documents/add',false);
    });
</script>