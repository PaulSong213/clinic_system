<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Document $document
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
             <p class="document-link">List Documents</p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="documents form content">
             <fieldset>
                <legend><?= __('Add Document') ?></legend>
<!--            add Files-->
            <?= $this->Form->create(null,[
                'type' => 'file',
                'enctype' => 'multipart/form-data',
                'id' => 'uploadFileForm'
            ]) ?>
            <?php
            
            
            echo $this->Form->control('documentSubmitted',[
                'type' => 'file',
                'multiple' => 'multiple',
                'name' => 'documentSubmitted[]',
                'label' => __('Choose Documents to Upload'),
                'id' => 'uploadFileInput'
            ]);
            
            ?>

            <?= $this->Form->end() ?>
            
             <small>Uploaded Files</small>
            <div class="uploadedFileContainer">
<!--                uploaded file will append here-->
            </div>
            
<!--            add document    -->
            <?= $this->Form->create($document,[
                'id' => 'mainAddForm',
                'enctype' => 'multipart/form-data',
            ]) ?>
           
                <?php
                    echo $this->Form->control('document_name',[
                        'id' => 'docName'
                    ]);
                    echo $this->Form->control('document_internal_path_name',[
                        'type' => 'hidden',
                        'value' => 'clinic-document'
                    ]);
                    echo $this->Form->control('document_files',[
                        'type' => 'hidden',
                        'id' => 'documentFilesId'
                    ]);
                    echo $this->Form->control('document_files_deletion',[
                        'type' => 'hidden',
                        'id' => 'documentFilesToDelete'
                    ]);
                    echo $this->Form->control('document_type_id', ['options' => $documentTypes]);
                    echo $this->Form->control('document_url');
                    echo $this->Form->control('details');
                    echo $this->Form->control('patient_id', ['options' => $patients, 'empty' => true]);
                    echo $this->Form->control('patient_case_id', ['options' => $patientCases, 'empty' => true]);
                    echo $this->Form->control('appointment_id', ['options' => $appointments, 'empty' => true]);
                    echo $this->Form->control('in_department_id', ['options' => $inDepartments, 'empty' => true]);
                    echo $this->Form->control('time_created');
                ?>
                <?= $this->Form->button(__('Submit')) ?>
            </fieldset>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script>
    //list of file id to be deleted in server
    //you can access also this to undo delete
    var toDeleteFileId = []; 
    function removeFileButton(fileIdArray = [], removeButton, fileIdInput){
        
        $(removeButton).click(function(){
            var currentRemoveButton = $(this);
            var currentFileId = $(this).attr('id');
            var indexToDelete = fileIdArray.indexOf(parseInt(currentFileId));
            
            if(indexToDelete !== -1){
                $(currentRemoveButton).parent().hide('slow',function(){
                    $(fileIdInput).val(fileIdArray);
                    toDeleteFileId.push(currentFileId);
                    $('#documentFilesToDelete').val(toDeleteFileId);
                });
            }
        });
    }
    
    function showRemoveFile(){
        
        $('.preview-img-add').hover(function(){
            var removerFile = $(this).parent().children('.remove-upload-file');
            removerFile.attr('style','opacity:1');
        },function(){
            var removerFile = $(this).parent().children('.remove-upload-file');
            removerFile.attr('style','opacity:0');
        });
        $('.remove-upload-file').hover(function(){
            var parentImage = $(this).parent().children('.preview-img-add');
            $(this).attr('style','opacity:1')
            parentImage.attr('style','opacity:0.3');
        },function(){
            var parentImage = $(this).parent().children('.preview-img-add');
            parentImage.attr('style','opacity:inheret');
        });
    }
    
    function uploadFileForm(uploadForm,addLink, uploadFileInput) {
        $(uploadFileInput).change(function(){
            var maxFileSize = 1048576 * 20;
            if(this.files[0].size > maxFileSize){
                Swal.fire({
                    title: 'Your File is too big',
                    html: "<p class='text-green-300'><bold>Solution:</bold>Upload your file in other website and put the link here as external copy</p>",
                    icon: 'warning'
                });
                this.value = "";
            }else{
                $(uploadForm).submit();
            }
        });
        
            $(uploadForm).on('submit', function (e) {
              var formData = new FormData(this);  
              Swal.fire({
                title: 'Please Wait',
                html: 'Submitting data to website',// add html attribute if you want or remove
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
                url: addLink,
                data: formData,
                success: function (data) {
                    
                   Swal.close(); 
                   //console.log(data);
                   
                   $('#uploadFileInput').val("");
                   
                    var uploadedFullInfo = JSON.parse(data);
                    var fileID = uploadedFullInfo['fileID'];
                    var filePath = uploadedFullInfo['filePaths'];
                    var fileName = uploadedFullInfo['fileNames'];
                    var documentFilesId = [];
                    for(var i = 0; i < fileID.length;i++){
                        var mainContainer = $('.uploadedFileContainer');
                        var container = $('<div class="small-file-container"></div>');
                        var imagePreview = $('<img>');
                        var title = $('<small></small>');
                        var removeUpload = $('<div class="remove-upload-file" id="'+fileID[i]+'"><ion-icon name="trash"></ion-icon></div>');
                        imagePreview.attr('src', "/clinic-document/"+filePath[i]);
                        imagePreview.attr('alt', 'preview');
                        imagePreview.attr('onerror', "this.onerror=null;this.src='/document.png';");
                        imagePreview.attr('class','preview-img-add');
                        title.html(fileName[i]);
                        container.append(removeUpload);
                        container.append(title);
                        container.append(imagePreview);
                        container.attr('class','preview-container');
                        
                        mainContainer.append(container);
                        documentFilesId[i] = fileID[i];
                    }
                    showRemoveFile();
                    $('#documentFilesId').val(documentFilesId);
                    removeFileButton(documentFilesId, '.remove-upload-file', '#documentFilesId');
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
    
    
    $(document).ready(function(){
    
        addForm('/documents/add','/documents');
        
        dataActions('.document-link','/documents',false);
        
        $('#docName').on('keypress', function (event) {
            var regex = new RegExp("^[&]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (regex.test(key)) {
               event.preventDefault();
               return false;
            }
        });
       
        uploadFileForm('#uploadFileForm','/document-files/upload','#uploadFileInput');
        
        
        
    });
    
</script>