<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appointment[]|\Cake\Collection\CollectionInterface $appointments
 */
?>
<div class="appointments index content" style="min-height: 80vh">
    <?= $this->Html->link(__('New Appointment'), ['action' => 'add'], 
            ['class' => 'button float-right']) ?>
    <h3><?= __('Appointments') ?></h3>
    
    <?php foreach ($appointments as $appointment): ?>
    <h4 class="mt-5">  <?= $appointment->has('in_department') ? 
            $this->Html->link('Department Details: '.$appointment->in_department->title, 
            ['controller' => 'InDepartments', 'action' => 'view',
            $appointment->in_department->id]) : '' ?></h4>
    <?php 
    break;
    endforeach; ?>
    
    <div class="showCardStatus p-5 transition-all 
         md:opacity-80 hover:opacity-100">
        <div class="flex flex-col ml-auto" style="width: fit-content; ">
            <select id="appointment-date" class="p-2 m-0 dark:bg-black dark:text-white" 
                    style="font-size: 1.2rem; border: none;">
              <option value="appointment-incoming" class="appointment-option">All Incoming</option>
              <option value="appointment-today" class="appointment-option">Today</option>
              <option value="appointment-week" class="appointment-option">Next 7 Days</option>
              <option value="appointment-anytime" class="appointment-option">Anytime</option>
            </select>
        </div>
        
        <p class="none-status-viewer inline-block py-1 px-8 m-1 rounded-lg 
           border border-blue-300 font-normal text-blue-400 transition-all
            noselect cursor-pointer hover:border-blue-600 hover:text-blue-500 dark:bg-blue-100
           dark:text-black">
            <ion-icon name="eye-off-outline" style="margin-bottom: -2px"></ion-icon> NONE</p>
        <p class="all-status-viewer inline-block py-1 px-8 m-1 rounded-lg 
           border border-blue-300 font-normal text-blue-400 transition-all
            noselect cursor-pointer hover:border-blue-600 hover:text-blue-500 dark:bg-blue-100
           dark:text-black">
            <ion-icon name="grid" style="margin-bottom: -2px"></ion-icon> ALL</p>
        <?php 
        $index = 0;
        foreach ($appointmentStatus as $status):
            $statusDetails = (explode("*",$status));
            //naming status for script
            //indexName will help to prevent looping appointment status in the script
        ?>
        <p class="status-viewer inline-block py-1 px-8 m-1 rounded-lg 
           border border-blue-300 cursor-pointer text-blue-800
           font-normal bg-blue-100 transition-all noselect 
           hover:border-blue-600 hover:text-blue-500 dark:text-black
           "
           id='<?= 'statview'.$statusDetails[0] ?>'>
                <?= $statusDetails[1]?></p>
            
        <?php endforeach; ?>
    </div>    
    <div class="card-container grid  p-3 my-5 gap-5 grid-cols-1 justify-center md:grid-cols-2
         lg:grid-cols-3" >
        <div class="no-appointment hidden">
            <h1 class="text-center">No Appointment to Show</h1>
            <ion-icon name="cloud-done" 
                class="block mx-auto text-green-500 text-9xl"></ion-icon>
        </div>
        <?php foreach ($appointments as $appointment):?>
        
        <div class="<?= 'card-type'.$appointment->appointment_status->id ?> hidden cards <?= 'card-date'.date('Y-m-d', strtotime($appointment->appointment_start_time)) ?>
             "
             id="<?= 'card'.$appointment->id ?>" >
        <div class=" bg-white border border-black rounded-lg  dark:border-none
              border-opacity-30 flex flex-col justify-between transition-all">
            
            <div class="<?= 'card-header'.$appointment->id ?> p-5 rounded-t-lg flex
                 justify-between transition-all" 
                 style="background-color: <?= $appointment->appointment_status->status_color ?>">
                
                <h1 class="bg-white px-4 py-2  rounded-full dark:bg-black"> 
                    <small>ID:  <?= $this->Number->format($appointment->id) ?></small></h1>
                <h1 class="bg-white px-4 py-2  rounded-full dark:bg-black">
                    <small> <?= $appointment->has('appointment_status') ? 
                    $this->Html->link($appointment->appointment_status->status_name, 
                    ['controller' => 'AppointmentStatus', 'action' => 'view',
                        $appointment->appointment_status->id],
                            ['id' => 'card-status'.$appointment->id])
                    : '' ?></small></h1>
            </div>
            
            <div class="main px-10 py-16 flex flex-col dark:bg-black" style="min-height: 20rem">
                
                <p class="mb-5">   <?= $appointment->has('patient_case') ? 
                $this->Html->link('Patient Details: '.$appointment->patient_case->full_details, 
                        ['controller' => 'PatientCases', 'action' => 'view', 
                         $appointment->patient_case->id]) : '' ?></p>
                
                <?php if($appointment->appointment_start_time !== null){?>
                <h1 class="text-green-600"><b><?= h($appointment->appointment_start_time) ?> - 
                <?= h($appointment->appointment_end_time) ?></b></h1>
                <?php }else{
                    echo '<h1 class="text-red-600"><b>Start Time not set</b></h1>';
                }
                ?>
                <h1 class=""><small> Created:  <?= h($appointment->time_created) ?>
                   </small></h1>    
            </div>
            
            <div class="<?= 'card-footer'.$appointment->id ?> p-5  rounded-b-lg flex flex-row  
                 justify-between transition-all"
                 style="background-color: <?= $appointment->appointment_status->status_color ?>">
                
                <div class="settings-trigger  bg-white text-black 
                     p-4 rounded-full hover:bg-green-100 dark:bg-black">
                    <ion-icon name="settings-outline" class="text-2x1 block m-auto 
                            settings-icon transition-all cursor-pointer dark:text-white">
                    </ion-icon>
                </div>
                
                <div>
                    <p class="status-change p-2 bg-white rounded-full border border-white 
                       cursor-pointer hover:bg-blue-300 noselect dark:bg-black">Change Status</p>
                </div>   
            </div> 
            
            <div class="flex flex-row p-2 hidden settings-container h-25 bg-white 
                 dark:bg-gray-800">
                    <ion-icon name="trash" class="rounded-full text-red-400 
                        bg-white p-3 mx-1 transition-all cursor-pointer hover:bg-blue-200
                        shadow-md border delete dark:bg-black dark:border-none" 
                        id="delt<?= $appointment->id?>">
                    </ion-icon>
                    <ion-icon name="create-sharp" class="edit rounded-full text-green-500 
                            bg-white p-3 mx-1 transition-all cursor-pointer 
                            hover:bg-blue-200 shadow-md border dark:bg-black dark:border-none"
                            id="edit<?= $appointment->id ?>">
                    </ion-icon>
                    <ion-icon name="folder-open" class="view rounded-full text-yellow-500 
                            bg-white p-3 mx-1 transition-all cursor-pointer 
                            hover:bg-blue-200 shadow-md border dark:bg-black 
                            dark:border-none" 
                            id="view<?= $appointment->id ?>">
                    </ion-icon>
            </div>
            
            <div class="p-1 status-container h-25 bg-white  text-lg  font-thin
                 bg-white w-full hidden dark:bg-gray-800">
                <div class="grid grid-cols-2 gap-1 p-2">    
                    <?php foreach ($appointmentStatus as $status):
                        $statusDetails = (explode("*",$status));
                    ?>
                        <h1 class=" bg-blue-500  status-button p-2 w-full tracking-wide
                            rounded-lg  cursor-pointer block  inline-block my-1 text-center 
                            text-white hover:text-white hover:bg-blue-600 "
                             id= "<?= $statusDetails[0].'*'.
                                    $appointment->id.'*'.$statusDetails[1].'*'.$statusDetails[2].'*'.$appointment->appointment_status->id ?>" >
                            <?= $statusDetails[1] ?></h1>

                    <?php 
                    endforeach;?>
                </div>        
            </div>     
        </div>
        </div>
        <?php endforeach; ?>
        
    </div>
    <?= $this->Form->create(null,[
        'id' => 'statusForm'
    ]) ?>
    
    <?php  echo $this->Form->control('appointment_status_id',
            ['type' => 'hidden',
              'id' => 'statusId']);?>
     <input type="hidden" name="_method" value="PUT"/>
    <?= $this->Form->end() ?>
    <?= $this->Form->postLink('') ?>
</div>

<script>
  
    var statusButtonActiveColorClass = 'bg-blue-100';
    var disabledCardClassByFilter = 'unAffected';
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    
    function filterAppointmentDate(){
        $('#appointment-date').each(function() {
         var option = $(this);
         // Save current value of element
         option.data('oldVal', option.val());
         // Look for changes in the value
         option.bind("propertychange change click keyup input paste", function(event){
            // If value has changed...
            if (option.data('oldVal') != option.val()) {
                // Updated stored value
                option.data('oldVal', option.val());
                var isCardEmpty = true;
                 $('.no-appointment').hide();
                
                
                $('.status-viewer').addClass(statusButtonActiveColorClass);
                switch (option.val()) {
                    case 'appointment-today':
                        var todayCard =  'card-date' + today;
                        $('.cards').hide('fast');
                        $('.cards').each(function(index,element) {
                            if($(element).hasClass(todayCard)){
                                $(element).show('fast');
                                isCardEmpty = false;
                            }else{
                                $(element).addClass(disabledCardClassByFilter);
                            }
                        });
                        showNoAppointment(isCardEmpty);
                    break;

                    case 'appointment-anytime':
                        $('.cards').removeClass(disabledCardClassByFilter);
                        $('.cards').show('fast');
                        
                        if('<?= sizeof($appointments) ?>' !== 0){
                            isCardEmpty = false;
                        }
                        showNoAppointment(isCardEmpty);
                    break;
                    
                    case 'appointment-week':
                        var week = listDays(today,7);
                        //console.log(week);
                        $('.cards').hide('fast');
                        $('.cards').each(function(index,element) {
                            //FOR LOOP results a bug which element is still added a disabledClass
                                if($(element).hasClass(week[0]) | $(element).hasClass(week[1]) | 
                                   $(element).hasClass(week[2]) | $(element).hasClass(week[3]) || 
                                   $(element).hasClass(week[4]) | $(element).hasClass(week[5]) | 
                                   $(element).hasClass(week[6]) | $(element).hasClass(week[7])){
                                    $(element).show('fast');
                                     isCardEmpty = false;
                                }else{
                                    $(element).addClass(disabledCardClassByFilter);
                                }
                        });
                        showNoAppointment(isCardEmpty);
                    break;
                    
                    case 'appointment-incoming':
                        $('.cards').hide('fast');
                        $('.cards').each(function(index,element) {
                            var cardClass = $(element).attr('class');
                            var cardClassDate = cardClass.split(' ')[3];
                            var cardDate = cardClassDate.slice(9, 23);
                            if(cardDate >= today){
                                $(element).show('fast');
                            }else{
                                $(element).addClass(disabledCardClassByFilter);
                            }
                        });
                        
                    break;
                    
                    default:
                        
                    break;
                }
               
            }
         });
         
            
            var selectedFilter = '<?= $filter?>';
            if(selectedFilter !== ""){
                $('#appointment-date').val(selectedFilter);
                $('#appointment-date').trigger('click');
            }
            
       });
       
    }
    
    function onStartShowIncomingAppointment(){
        if($('#appointment-date').val() === 'appointment-incoming'){
            $('.cards').hide('fast');
            $('.cards').each(function(index,element) {
                var cardClass = $(element).attr('class');
                var cardClassDate = cardClass.split(' ')[3];
                var cardDate = cardClassDate.slice(9, 23);
                if(cardDate >= today){
                    $(element).show('fast');
                }else{
                    $(element).addClass(disabledCardClassByFilter);
                }
            });
        }
        
    }
    
    function showNoAppointment(isCardEmpty){
        if (isCardEmpty){
            $('.no-appointment').show('fast');
            $('.card-container').attr('style','display:flex');
        }else{
           $('.no-appointment').hide('fast');
           $('.card-container').attr('style','display:grid');
        }
    }
    
    function addDay(date, days) {
        var result = new Date(date);
        result.setDate(result.getDate() + days);
        return result;
    }
    
    function listDays(startDate,targetDay){
        var daysList = [];
        var currentDay = startDate;
        for (var i = 0; i < targetDay + 1; i++) {
            daysList[i] = addDay(currentDay,i);
            var dd = String(daysList[i].getDate()).padStart(2, '0');
            var mm = String(daysList[i].getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = daysList[i].getFullYear();
            daysList[i] = 'card-date' + yyyy + '-' + mm + '-' + dd;
        }
        
        return daysList;
    }
    
    
    function changeStatus(button){
        var selectedID = $(button).attr('id');
        var appointmentIdandStatusId = selectedID.split("*");
        var statusId = appointmentIdandStatusId[0];
        var appointmentId = appointmentIdandStatusId[1];
        var statusName = appointmentIdandStatusId[2];
        var statusColor = appointmentIdandStatusId[3];
        var cardPrevStatus = appointmentIdandStatusId[4];
        showMainLoader();
        $('#statusId').attr('value',statusId);
        $.ajax({
            type: "POST",
            url: "/appointments/changeStatus/"+ appointmentId,
            data: $("#statusForm").serialize(),
            beforeSend: function(request) {
                request.setRequestHeader('X-CSRF-Token', 
                $('[name="_csrfToken"]').val());
            },
            success: function(data) {
                
                if(data === 'success'){
                    $('.card-header' + appointmentId).attr('style','background-color:'+ statusColor);
                    $('.card-footer' + appointmentId).attr('style','background-color:'+ statusColor);
                    $('#card-status' + appointmentId).html(statusName);
                    $('#card' + appointmentId).removeClass('card-type' + cardPrevStatus);
                    $('#card' + appointmentId).addClass('card-type' + statusId);
                    
                    var viewer = $('#statview' + statusId);
                    
                    if(!viewer.hasClass(statusButtonActiveColorClass)){
                        $('#card' + appointmentId).hide('fast');
                    }
                    
                    hideMainLoader();
                }else {
                    alert('An Error has occure please try again. Page will reload');
                    location.reload();
                }
            }

        });
        
        
    }
    
    
    $(document).ready(function(){
        
        var settings =  $('.settings-container');
        var status = $('.status-container');
        
        $('.edit').click(function(){
            var id = $(this).attr('id');
            var appointmentId = id.slice(4, 14);
            setMainContent('/appointments/edit/'+ appointmentId);
        });
        
        $('.view').click(function(){
            var id = $(this).attr('id');
            var appointmentId = id.slice(4, 14);
            setMainContent('/appointments/view/'+ appointmentId);
        });
        
        $('.delete').click(function(){
            showMainLoader();
            var id = $(this).attr('id');
            var appointmentId = id.slice(4, 14);
            $.ajax({
                url: '/appointments/delete/' + appointmentId ,
                type: 'post',
                data: null,
                beforeSend: function(request) {
                request.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                success: function(data) {
                    hideMainLoader();
                    var deletedCard = $('#card' + appointmentId);
                    deletedCard.hide('slow', function(){
                        deletedCard.remove(); 
                    });
                    alert('deleted');
                },
                error: function(data) {
                    hideMainLoader();
                    alert('An error occured, please try again');
                    //console.log(data.responseText);
                    //location.reload();
                },
            });
        });
        
        $('.settings-trigger').click(function(){
           if(status.is(":visible")){
               status.hide('fast');
               $('.status-change').attr('style','background-color: #fff');
           }
           if(settings.is(":visible")){
               settings.hide('fast');
               $('.settings-icon').attr('style',' transform: rotate(0deg);');
           }else {
               settings.show('fast');
               $('.settings-icon').attr('style',' transform: rotate(1000deg);color:#7f31de');
           }
        });
        
        $('.status-change').click(function(){
           if(settings.is(":visible")){
               settings.hide('fast');
               $('.settings-icon').attr('style',' transform: rotate(0deg);');
           }
           
           if(status.is(":visible")){
               $('.status-change').attr('style','border-color: #fff');
               status.hide('fast');
           }else {
               $('.status-change').attr('style','border-color: #7f31de');
               status.show('fast');
           }
        });
        
        $('.status-button').click(function(){
            changeStatus(this);
        });
        
        
        //the first type of status will show in card container while others 
        //should be triggered by users
        
        $('.status-viewer').click(function(){
            var id = $(this).attr('id');
            var statusIdToShow = id.slice(8, 16);
            var cardToShow =  $('.card-type' + statusIdToShow);
            
            var option = $('#appointment-date');
            if(option.val() !== 'appointment-anytime'){
                $(cardToShow).each(function(index,element) {
                    if(!$(element).hasClass(disabledCardClassByFilter)){
                        $(element).toggle('fast');
                    }
                });
            }else {
                cardToShow.toggle('fast');
               
            }
            if($(this).hasClass(statusButtonActiveColorClass)){
                $(this).removeClass(statusButtonActiveColorClass);
            }else{
                $(this).addClass(statusButtonActiveColorClass);
            }
            
            
            
        });
        
        $('.all-status-viewer').click(function(){
            $('.cards').each(function(index, element){
                if(!$(element).hasClass(disabledCardClassByFilter)){
                     $(element).show('fast');
                }
            });
           
            $('.status-viewer').addClass(statusButtonActiveColorClass);
        });
        
        $('.none-status-viewer').click(function(){
            $('.cards').hide('fast');
            $('.status-viewer').removeClass(statusButtonActiveColorClass);
        });
               
        filterAppointmentDate();
        onStartShowIncomingAppointment();
        
    });
</script>

