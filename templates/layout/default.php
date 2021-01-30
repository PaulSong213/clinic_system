<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

date_default_timezone_set('Asia/Manila');
$appTitle = 'Demo Clinic';
?>
<!DOCTYPE html>
<html class="<?php
if(isset($_COOKIE['userTheme'])) {
     echo $_COOKIE['userTheme'];
}
?>">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $appTitle ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta(
        'songalia-icon.png',
        '/songalia-icon.png',
        ['type' => 'icon']
    ); ?>

    
    <?= $this->Html->script(['chart.js/dist/chart','sweetalert2/dist/sweetalert2.all.js','dropzone/dist/dropzone']) ?>
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake','tailwindcss/dist/tailwind',
        '../js/sweetalert2/dist/sweetalert2.css','../js/DataTables/datatables.css']) ?>
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>
<body class="dark:bg-gray-800">
    <nav class="top-nav bg-white shadow-md mb-5 dark:bg-gray-900">
        <div class="top-nav-title ">
            <ion-icon name="menu-outline" class="nav-logo" id="nav-logo" >
            </ion-icon>
            <h1 class="text-4xl text-green-600 brand-logo dark:text-gray-400"><?= $appTitle ?></h1>
        </div>
        <div class="top-nav-links">
            <a target="_blank" rel="noopener" href="https://book.cakephp.org/4/">Documentation</a>
            <a target="_blank" rel="noopener" href="https://api.cakephp.org/">API</a>
        </div>
    </nav>

    <div class="loader"></div>
    <main class="main  main-grid">
        <div class="overflow-auto bg-white shadow-lg rounded-lg main-side-nav text-left
              pt-5 flex flex-col  text-gray-700 sm:px-2 dark:bg-gray-900 dark:text-gray-400"
             style="height: 80vh;">
                <ion-icon name="close-outline" class="bg-red-300 mb-5 rounded-full p-2 text-white"
                          id="side-nav-close"></ion-icon>
                <a class="side-nav-link py-2 cursor-pointer noselect mx-0"
                   onclick="setMainContent('/pages/dashboard')"> 
                    <ion-icon name="clipboard-outline" class="ml-8 text-blue-700"
                              ></ion-icon>Dashboard</a>
                
                <div class="appointment flex flex-col">
<!--                    dropdown Title-->
                    <a onclick="dropContent('#doctorDropDown','#drop-doctor-icon' )" 
                       class="side-nav-link ml-0 noselect" >
                        <ion-icon name="chevron-forward-outline" 
                        class="side-nav-link-drop" id="drop-doctor-icon"></ion-icon>
                        Appointment</a>
<!--                    dropdown Item-->
                    <div id="doctorDropDown" class="hidden drop-container">
                        <a class="side-nav-link noselect"
                            onclick="setMainContent('/appointments/departmentApointment')">
                             <ion-icon name="cafe-outline" class="side-nav-link-icon" >
                             </ion-icon>My Appointments</a>
                        <a class="side-nav-link noselect"
                            onclick="setMainContent('/appointments')">
                             <ion-icon name="reader-outline" class="side-nav-link-icon" >
                             </ion-icon>Table view <small>(My Appointments)</small> </a>
                         <a class="side-nav-link noselect"
                            onclick="setMainContent('/appointments/add')">
                             <ion-icon name="pencil-outline" class="side-nav-link-icon">
                             </ion-icon>Add Appointment</a>
                    </div>
                </div>
                
                <div class="employees  flex flex-col">
<!--                    dropdown Title-->
                    <a onclick="dropContent('#userDropDown','#drop-user-icon' )" 
                       class="side-nav-link ml-0 noselect ">
                        <ion-icon name="chevron-forward-outline" 
                        class="side-nav-link-drop" id="drop-user-icon"></ion-icon>
                        Employees</a>
<!--                    dropdown Item-->
                    <div id="userDropDown" class="drop-container hidden">
                        <a class="side-nav-link noselect"
                        onclick="setMainContent('/employees')">
                         <ion-icon name="person-outline" class="side-nav-link-icon">
                         </ion-icon>List employee</a>
                        <a class="side-nav-link noselect"
                        onclick="setMainContent('/employees/add')">
                         <ion-icon name="person-add-outline" class="side-nav-link-icon">
                         </ion-icon>Add employee</a>
                    </div>
                </div>
            
                <div class="has-role flex flex-col">
<!--                    dropdown Title-->
                    <a onclick="dropContent('#hasRoleDropDown','#drop-has-role-icon' )" 
                       class="side-nav-link ml-0 noselect">
                        <ion-icon name="chevron-forward-outline" 
                        class="side-nav-link-drop" id="drop-has-role-icon"></ion-icon>
                        Has Roles</a>
<!--                    dropdown Item-->
                    <div id="hasRoleDropDown" class="hidden drop-container">
                        <a class="side-nav-link noselect"
                            onclick="setMainContent('/has-roles')">
                             <ion-icon name="bookmark-outline" class="side-nav-link-icon" >
                             </ion-icon>List Employee that has Role</a>
                         <a class="side-nav-link noselect"
                            onclick="setMainContent('/has-roles/add')">
                             <ion-icon name="pencil-outline" class="side-nav-link-icon">
                             </ion-icon>Add Role to Employee</a>
                    </div>
                </div>
                
                <div class="in-department flex flex-col">
<!--                    dropdown Title-->
                    <a onclick="dropContent('#inDepartmentDropDown','#drop-in-department-icon' )" 
                       class="side-nav-link ml-0 noselect">
                        <ion-icon name="chevron-forward-outline" 
                        class="side-nav-link-drop" id="drop-in-department-icon"></ion-icon>
                        In Department</a>
<!--                    dropdown Item-->
                    <div id="inDepartmentDropDown" class="hidden drop-container">
                        <a class="side-nav-link noselect"
                            onclick="setMainContent('/in-departments')">
                             <ion-icon name="business-outline" class="side-nav-link-icon" >
                             </ion-icon>List Employee in Departments</a>
                         <a class="side-nav-link noselect"
                            onclick="setMainContent('/in-departments/add')">
                             <ion-icon name="pencil-outline" class="side-nav-link-icon">
                             </ion-icon>Add Employee to Department</a>
                    </div>
                </div>
            
            
                 <div class="documents flex flex-col">
<!--                    dropdown Title-->
                    <a onclick="dropContent('#documentDropDown','#drop-document-icon' )" 
                       class="side-nav-link ml-0 noselect">
                        <ion-icon name="chevron-forward-outline" 
                        class="side-nav-link-drop" id="drop-document-icon"></ion-icon>
                        Documents</a>
<!--                    dropdown Item-->
                    <div id="documentDropDown" class="hidden drop-container">
                        <a class="side-nav-link noselect"
                            onclick="setMainContent('/documents')">
                             <ion-icon name="documents-outline" class="side-nav-link-icon" >
                             </ion-icon>List Documents</a>
                         <a class="side-nav-link noselect"
                            onclick="setMainContent('/documents/add')">
                             <ion-icon name="pencil-outline" class="side-nav-link-icon">
                             </ion-icon>Add Documents</a>
                    </div>
                </div>
                
                <div class="files flex flex-col">
<!--                    dropdown Title-->
                    <a onclick="dropContent('#fileDropDown','#drop-file-icon' )" 
                       class="side-nav-link ml-0 noselect">
                        <ion-icon name="chevron-forward-outline" 
                        class="side-nav-link-drop" id="drop-file-icon"></ion-icon>
                        Files</a>
<!--                    dropdown Item-->
                    <div id="fileDropDown" class="hidden drop-container">
                        <a class="side-nav-link noselect"
                            onclick="setMainContent('/document-files')">
                             <ion-icon name="document-outline" class="side-nav-link-icon" >
                             </ion-icon>List files</a>
                         <a class="side-nav-link noselect"
                            onclick="setMainContent('/document-files/add')">
                             <ion-icon name="pencil-outline" class="side-nav-link-icon">
                             </ion-icon>Add Files</a>
                    </div>
                </div>
            
                <div class="patients flex flex-col">
<!--                    dropdown Title-->
                    <a onclick="dropContent('#patientsDropDown','#patients-icon' )" 
                       class="side-nav-link ml-0 noselect">
                        <ion-icon name="chevron-forward-outline" 
                        class="side-nav-link-drop" id="patients-icon"></ion-icon>
                        Patients</a>
<!--                    dropdown Item-->
                    <div id="patientsDropDown" class="hidden drop-container">
                        <a class="side-nav-link noselect"
                            onclick="setMainContent('/patients')">
                             <ion-icon name="heart-circle-outline" class="side-nav-link-icon" >
                             </ion-icon>List Patients</a>
                         <a class="side-nav-link noselect"
                            onclick="setMainContent('/patients/add')">
                             <ion-icon name="pencil-outline" class="side-nav-link-icon">
                             </ion-icon>Add Patients</a>
                    </div>
                </div>
                
                <div class="patient-cases flex flex-col">
<!--                    dropdown Title-->
                    <a onclick="dropContent('#patientCasesDropDown','#patient-cases-icon' )" 
                       class="side-nav-link ml-0 noselect">
                        <ion-icon name="chevron-forward-outline" 
                        class="side-nav-link-drop" id="patient-cases-icon"></ion-icon>
                        Patients Cases</a>
<!--                    dropdown Item-->
                    <div id="patientCasesDropDown" class="hidden drop-container">
                        <a class="side-nav-link noselect"
                            onclick="setMainContent('/patient-cases')">
                             <ion-icon name="file-tray-outline" class="side-nav-link-icon" >
                             </ion-icon>List Patient Cases</a>
                         <a class="side-nav-link noselect"
                            onclick="setMainContent('/patient-cases/add')">
                             <ion-icon name="pencil-outline" class="side-nav-link-icon">
                             </ion-icon>Add Patient Case</a>
                    </div>
                </div>
            
                <div class="status-histories flex flex-col">
<!--                    dropdown Title-->
                    <a onclick="dropContent('#statusHistoriesCasesDropDown',
                                '#status-histories-icon' )" 
                       class="side-nav-link ml-0 noselect">
                        <ion-icon name="chevron-forward-outline" 
                        class="side-nav-link-drop" id="status-histories-icon"></ion-icon>
                        Status Histories</a>
<!--                    dropdown Item-->
                    <div id="statusHistoriesCasesDropDown" class="hidden drop-container">
                        <a class="side-nav-link noselect"
                            onclick="setMainContent('/status-histories')">
                             <ion-icon name="attach-outline" class="side-nav-link-icon" >
                             </ion-icon>List Patient Status Histories</a>
                         <a class="side-nav-link noselect"
                            onclick="setMainContent('/status-histories/add')">
                             <ion-icon name="pencil-outline" class="side-nav-link-icon">
                             </ion-icon>Add Status Histories</a>
                    </div>
                </div>
            
                <div class="configuration  flex flex-col">
<!--                    dropdown Title-->
                    <a onclick="dropContent('#configurationDropDown','#drop-config-icon' )" 
                       class="side-nav-link ml-0 noselect">
                        <ion-icon name="chevron-forward-outline" 
                        class="side-nav-link-drop" id="drop-config-icon"></ion-icon>
                        Configurations</a>
<!--                    dropdown Item-->
                    <div id="configurationDropDown" class="hidden drop-container">
                        <a class="side-nav-link noselect"
                            onclick="setMainContent('/clinics')">
                             <ion-icon name="heart-half-outline" class="side-nav-link-icon">
                             </ion-icon>Clinics</a>
                        <a class="side-nav-link noselect"
                            onclick="setMainContent('/departments')">
                             <ion-icon name="business-outline" class="side-nav-link-icon ">
                             </ion-icon>Departments</a>
                        <a class="side-nav-link noselect"
                            onclick="setMainContent('/appointment-status')">
                             <ion-icon name="cafe-outline" class="side-nav-link-icon" >
                             </ion-icon>Appointment Status</a>
                        <a class="side-nav-link noselect"
                            onclick="setMainContent('/roles')">
                             <ion-icon name="bookmark-outline" class="side-nav-link-icon">
                             </ion-icon>Employee Roles</a>
                        
                        <a class="side-nav-link noselect"
                            onclick="setMainContent('/genders')">
                             <ion-icon name="transgender-outline" class="side-nav-link-icon">
                             </ion-icon>Gender Options</a>
                        <a class="side-nav-link noselect"
                            onclick="setMainContent('/document-types')">
                             <ion-icon name="document-attach-outline" class="side-nav-link-icon">
                             </ion-icon>Document Types</a>
                        <a class="side-nav-link noselect"
                            onclick="setMainContent('/schedules')">
                             <ion-icon name="time-outline" class="side-nav-link-icon">
                             </ion-icon>Schedules</a>
                    </div>
                </div>
            
                 <div class="settings flex flex-col">
                    
                    <a onclick="setMainContent('/clinics/system-settings')" 
                       class="side-nav-link ml-0 noselect">
                        <ion-icon name="settings-outline" 
                        class="ml-5"  style="margin-bottom: -3px;"></ion-icon>
                        System Settings</a>
                </div>
                
        </div>
        <div class="main-content">
            <?= $this->Flash->render() ?>
            
<!--            I use ajax so this method will no longer be used-->
            <?php // echo $this->fetch('content') ?>
             
        </div>
    </main>
    <footer>
    </footer>
    
    <script type="module" src="https://unpkg.com/ionicons@5.2.3/dist/ionicons/ionicons.esm.js"></script>
    <script
        language="JavaScript"
        type="text/javascript"
        src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
    <?= $this->Html->script('DataTables/datatables.js')?>
    
    <script>
        

        
        function setDefaultFullName(optionId, fullNameId){
            $(optionId).click(function(){
                //Get text or inner html of the selected option
                var selectedText = $(optionId + " option:selected").html();
                $(fullNameId).attr('value', selectedText); 
            });
        }
        
        function addForm(addLink, homeLink, addingForm = '#mainAddForm') {
            $(addingForm).on('submit', function (e) {
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
                success: function () {
                    swal.close(); 
                    Swal.fire({
                     title: 'Data Added!',
                     text: "Return to home page?",
                     icon: 'success',
                     width: 'fit-content',
                     padding: '1.5rem',
                     showCancelButton: true,

                     confirmButtonText: 'Yes, return to home page',
                     cancelButtonText: 'No, add data again.'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        setMainContent(homeLink);
                      }
                    });

                    $('form *').filter(':input').each(function(){
                        var element = $(this); 
                        if(!element.hasClass('hasDefaultValue')){
                            element
                            .not(':button, :submit, :reset, :hidden')
                            .val('')
                            .prop('checked', false)
                            .prop('selected', false);
                       }
                    });
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
        
        function scrollToAction(){
            var container = $('.content .table-responsive');
            
            container.append('<ion-icon name="arrow-forward-outline" class="scroll-action"></ion-icon>');
            $('.scroll-action').mouseenter(function(){
                $(this).addClass('opacity-80');
            });
            $('.scroll-action').mouseleave(function(){
                $(this).removeClass('opacity-80');
            });
            $('.scroll-action').click(function(){
                var container = $(this).parent();
                container.scrollLeft(10000);
            });
        }
        
        function viewZoomAction(){
            var container = $('.related .table-responsive');
            container.prepend('<p class="zoom-action"> zoom out </p>');
            var isZoomedOut = false;
            $('.zoom-action').mouseenter(function(){
                $(this).addClass('opacity-80');
            });
            $('.zoom-action').mouseleave(function(){
                $(this).removeClass('opacity-80');
            });
            $('.zoom-action').click(function(){
                if(!isZoomedOut){
                    var container = $(this).parent();
                    container.attr('style', 'font-size:10px');
                    isZoomedOut = true;
                    $(this).html('zoom in');
                }else{
                    var container = $(this).parent();
                    container.attr('style', 'font-size:inheret');
                    isZoomedOut = false;
                     $(this).html('zoom out');
                }
                
            });
        }
        
        function dropContent(id, dropIcon){
            if($(id).is(":visible")){
                $(id).hide();
                $(dropIcon).attr('style', 'transform: rotate(0deg)');
            }else {
                $(id).show();
                $(dropIcon).attr('style', 'transform: rotate(90deg)');
                $(id).attr('style', 'display:flex; flex-flow: column;');
            }

        }
       
        function loadMainContent(pageOnMainContent = window.location.href ){
            $('.loader').show();
            $.ajax({
                url: pageOnMainContent,
                type: 'get',
                data: 'none',
                beforeSend: function(request) {
                request.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data) {
                   $('.page-content').remove(); 
                   $('.main-content').append('<div class="page-content">' + data);
                   window.history.pushState({"html":data.html,"pageTitle":data.pageTitle},"", pageOnMainContent);
                   $('.loader').hide();
                },
                
            });
        }
        
        function foreignMainContent(foreignLink){
            $(foreignLink).click(function(){
                if($(this).html() !== ""){
                    setMainContent($(this).attr('id'));
                }    
            });
        }
        
        function setMainContent(url){
            $('.page-content').remove();
            loadMainContent(url);
            $('.main-side-nav ').attr('style','left: -300px;opacity: 1;');
        }
       
        window.onpopstate = function(e){
            if(e.state){
                $('.page-content').remove();
                setMainContent(e.state.html);
            }
        };
        
        
        function showMainLoader(){
            $('.loader').show();
        }
        function hideMainLoader(){
            $('.loader').hide();
        }
        
        
        function dataActions(actionType, actionUrl,hasIdToTarget = true){
           
            $(actionType).click(function(){
                if(hasIdToTarget){
                    var id = $(this).attr('id').slice(1,15);
                    setMainContent(actionUrl + id);
                }else{
                    setMainContent(actionUrl);
                }
            });
        }

        function dataDeleteAction( deleteUrl ,redirectUrl,isDataOnTable = true,underRelatedPosition = ""){
            
            var deleteButton = '.delete';
            
            if(underRelatedPosition !== ""){
                deleteButton = underRelatedPosition;
            }
            
            $(deleteButton).click(function(){
                Swal.fire({
                    title: 'Delete this row?',
                    text: "This action cannot not be undo!",
                    icon: 'warning',
                    width: 'fit-content',
                    padding: '1.5rem',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete this row',
                    cancelButtonText: 'Cancel'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        
                         Swal.fire({
                            title: 'Please Wait',
                            html: 'Deleting data on website',// add html attribute if you want or remove
                            allowOutsideClick: false,
                            showCancelButton: false,
                            showConfirmButton: false,
                            willOpen: () => {
                                Swal.showLoading();
                            },
                        });
                         var id = $(this).attr('id').slice(1,15);
                         //alert(deleteUrl + id);
                         var button = $(this);
                         $.ajax({
                            url: deleteUrl + id,
                            type: 'post',
                            data: null,
                            beforeSend: function(request) {
                                request.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                            },
                            success: function(data) {
                               const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                      toast.addEventListener('mouseenter', Swal.stopTimer)
                                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                  });
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Data has been deleted.'
                                }); 
                               if(isDataOnTable){
                                   button.parent().parent().hide('slow','swing',function(){
                                        var table = button.parent().parent().parent().parent();
                                        var dataTablePlugin = table.DataTable();
                                        dataTablePlugin
                                            .row(button.parents('tr') )
                                            .remove()
                                            .draw();
                                   });
                               }else{
                                   setMainContent(redirectUrl);
                               }
                            },
                            error: function(data){
                               Swal.fire({
                                    title: 'Database Error. Data has not been Deleted',
                                    html: "This row is related to other data which results on being \n\
                                    prevented on deletion.<br/><bold class='text-green-500'> Solution: Delete related data first \n\
                                    before deleting this row.</bold>",
                                    icon: 'info',
                                    width: 'fit-content',
                                    padding: '1.5rem',
                                    showCancelButton: true,
                                    confirmButtonText: 'View Related data',
                                    cancelButtonText: 'Cancel action'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        setMainContent(redirectUrl + '/view/' + id);
                                    }
                                });
                            }

                        });
                        
                    }
                  });
                
               

            });
        }
        function editForm(editForm,homeLink) {
            var editLink = $(editForm).attr('id'); 
            $('form').on('submit', function (e) {
              Swal.fire({
                title: 'Please Wait',
                html: 'Editing data on Website',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
              e.preventDefault();
              $.ajax({
                type: 'post',
                url: editLink,
                data: $('form').serialize(),
                success: function () {
                   swal.close(); 
                   setMainContent(homeLink);
                   const Toast = Swal.mixin({
                       toast: true,
                       position: 'top-end',
                       showConfirmButton: false,
                       timer: 3000,
                       timerProgressBar: true,
                       didOpen: (toast) => {
                         toast.addEventListener('mouseenter', Swal.stopTimer)
                         toast.addEventListener('mouseleave', Swal.resumeTimer)
                       }
                     });
                   Toast.fire({
                       icon: 'success',
                       title: 'Data has been updated.'
                   }); 
                },
                error: function(){
                    Swal.fire({
                        title: 'Unexpected ocuured. Please try again',
                        html: "Page will reload. Please wait.",
                        icon: 'error'
                    });
                    location.reload();
                }
              });
            });
         }
    
        function relatedDeleteActions(relatedClass){
            $(relatedClass).click(function(){
                var button = $(this);
                Swal.fire({
                    title: 'Delete this row?',
                    text: "This action cannot not be undo!",
                    icon: 'warning',
                    width: 'fit-content',
                    padding: '1.5rem',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete this row',
                    cancelButtonText: 'Cancel'
                  }).then((result) => {
                    if (result.isConfirmed) {
                     
                      Swal.fire({
                         title: 'Please Wait',
                         html: 'Deleting data on website',// add html attribute if you want or remove
                         allowOutsideClick: false,
                         showCancelButton: false,
                         showConfirmButton: false,
                         willOpen: () => {
                             Swal.showLoading();
                         },
                     });
                var deleteUrl = $(this).attr('id');
                 $.ajax({
                    url: deleteUrl,
                    type: 'post',
                    data: null,
                    beforeSend: function(request) {
                    request.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                    },
                    success: function(data) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                              toast.addEventListener('mouseenter', Swal.stopTimer)
                              toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                          });
                        Toast.fire({
                            icon: 'success',
                            title: 'Data has been deleted.'
                        }); 
                       button.parent().parent().hide('slow');
                    },
                    error: function(data){
                        Swal.fire({
                            title: 'Database Error. Data has not been Deleted',
                            html: "This row is related to other data which results on being \n\
                            prevented on deletion.<br/><bold class='text-green-500'> Solution: Delete related data first \n\
                            before deleting this row.</bold>",
                            icon: 'info',
                            width: 'fit-content',
                            padding: '1.5rem',
                            showCancelButton: true,
                            confirmButtonText: 'View Related data',
                            cancelButtonText: 'Cancel action'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                setMainContent(redirectUrl + '/view/' + id);
                            }
                        });
                    }

                });
                }
             });
                
            });
        }
       
        
        function dataTableForeignActions(tableSelector,columnHasDate,postLink,
            varInForeignArray,tableForeignCount,foreignColumn,mainContentLink){

            var childRowAction = $(tableSelector + " thead tr th").length;
            var actionColumn = $(tableSelector + " tbody tr td:nth-child("+ childRowAction +")");
            var idColumn = $(tableSelector + ' tbody tr td:nth-child(1)');
            actionColumn.remove();
            idColumn.each(function(index, element){
                
                if(!$('.dataTables_empty').is(":visible")){
                    
                    
                    //add needed id value for actions elements
                    var rowId = $(element).html();
                    var target = index + 1;
                    var currentActionRow = $(tableSelector + " tbody tr:nth-child("+ target +")");
                    var actionElements = "<td class='actions'><p class='view' id='v"+rowId+"' >View</p><p class='edit' id='e"+ rowId +"' >Edit</p><p class='delete' id='d"+ rowId +"' >Delete</p></td>";
                    currentActionRow.append(actionElements);

                    for(var i = 0; i < columnHasDate.length; i++){
                        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                        var currentCellHasDate = $(tableSelector + " tbody tr:nth-child("+ target +") td:nth-child("+columnHasDate[i]+")");
                        if(currentCellHasDate.html() !== ""){
                            var currentCellDate = new Date(currentCellHasDate.html());
                            currentCellHasDate.html(currentCellDate.toLocaleDateString("en-US", options));
                        }

                    }
                    
                    
                    
                    //foreign column
                    if(foreignColumn.length > 0){
                        if(foreignColumn.length % 2 === 0){
                            for(var i = 0; i < tableForeignCount; i++){
                                if(foreignColumn[i * varInForeignArray] > 0){
                                    var foreignIdCurrentColumn = (childRowAction - tableForeignCount) + i;
                                    var foreignIdCurrentRow = $(tableSelector + 
                                            " tbody tr:nth-child("+target+") td:nth-child("+foreignIdCurrentColumn+")");
                                    var foreignId = foreignIdCurrentRow.html();

                                    var foreignCellCurrentRow = $(tableSelector + 
                                            " tbody tr:nth-child("+target+") td:nth-child("+foreignColumn[i * varInForeignArray]+")");
                                    var foreign1Link = foreignColumn[(i * varInForeignArray) + 1];
                                    foreignCellCurrentRow.attr('id',foreign1Link + foreignId);
                                }
                            }
                        }else{
                            console.log('invalid foreign array it should be even');
                        }
                    }
                }
            });
            $('.delete').append(postLink);
            
            $(tableSelector + ' thead tr th').removeClass('foreign');
            dataActions(tableSelector + " tbody .actions .view", mainContentLink + '/view/');
            dataActions(tableSelector + " tbody .actions .edit",mainContentLink + '/edit/');
            dataDeleteAction(mainContentLink + '/delete/', mainContentLink, true, tableSelector + " tbody .actions .delete");
            foreignMainContent('.foreign');
        }
        
        function deleteCookie(){
            window.onbeforeunload = function(event)
            {
               document.cookie = "userPrefferedTableRow= ; expires=Fri, 31 Dec 9999 12:00:00 UTC; path=/";

            };
        }
        
        $(document).ready(function(){
            loadMainContent();
            $('#nav-logo').click(function(){
               $('.main-side-nav ').attr('style','left: 0px;opacity: 1;');
            });

            $('#side-nav-close').click(function(){
               $('.main-side-nav ').attr('style','left: -300px;opacity: 1;');
            });
            
            $('.main-content').click(function(){
                 $('.main-side-nav ').attr('style','left: -300px;opacity: 1;');
            });
            deleteCookie();
        });
    </script>   
</body>
</html>
