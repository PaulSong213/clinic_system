<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<style>
    
    .dashboard-label {
        font-size: 1.2rem;
        font-weight: 600;
    }
    
    .dashboard-icon {
        min-width: 3rem;
    }
    
</style>

<div class="bg-white rounded-lg shadow-lg p-10 content pt-2" style="min-height: 100vh">
    <div class="settings pb-10 flex justify-between"
         style="transition: ease-in-out 350ms">
        <div class="theme-change flex cursor-pointer"  
             style="width: fit-content">
            <small class="noselect">Dark</small>
            <div class="rounded-full border-2 mx-4 py-0 flex w-14
                 theme-icon">
                <ion-icon name="contrast-outline" style="margin-top:2px; height: 10px"></ion-icon>
            </div>
            <small class="noselect">Light</small>
        </div>
       
        <small id="time" class="noselect"><small>
    </div>
    
    <div class="appointments grid gap-2 grid-cols-2 xl:grid-cols-4">
        
        <div class="dashboard-container cursor-pointer bg-yellow-900 md:bg-transparent" 
             id="appointment-today">
            <div class="dashboard-icon-container md:bg-yellow-900">
                <ion-icon name="cafe" class="dashboard-icon" ></ion-icon>
            </div>
            <div class="dashboard-text-container" >
                <h1 class="dashboard-title" id="totalAppointToday">
                </h1>
                <div class="animate-appointment-count text-animation-container">
                    <div class="text-animation"></div>
                    <div class="text-animation w-3/6"></div>
                     <div class="text-animation w-6/6"></div>
                </div>
                <h1 class="dashboard-label">Appointments Today</h1>
            </div>
        </div>
        
        <div class="dashboard-container cursor-pointer bg-yellow-900 md:bg-transparent" id="appointment-week">
            <div class="dashboard-icon-container md:bg-yellow-900">
                <ion-icon name="calendar-clear" class="dashboard-icon" ></ion-icon>
            </div>
            <div class="dashboard-text-container" >
                <h1 class="dashboard-title" id="totalAppointWeek">
                </h1>
                <div class="animate-appointment-count text-animation-container">
                    <div class="text-animation"></div>
                    <div class="text-animation w-3/6"></div>
                     <div class="text-animation w-6/6"></div>
                </div>
                <h1 class="dashboard-label">Appointments in next 7 Days</h1>
            </div>
        </div>
        
        <div class="dashboard-container cursor-pointer bg-yellow-900 md:bg-transparent" id="appointment-incoming">
            <div class="dashboard-icon-container md:bg-yellow-900">
                <ion-icon name="time" class="dashboard-icon" ></ion-icon>
            </div>
            <div class="dashboard-text-container" >
                <h1 class="dashboard-title" id="totalAppointIncoming">
                </h1>
                <div class="animate-appointment-count text-animation-container">
                    <div class="text-animation"></div>
                    <div class="text-animation w-3/6"></div>
                     <div class="text-animation w-6/6"></div>
                </div>
                <h1 class="dashboard-label">Incoming Appointment</h1>
            </div>
        </div>
        
        <div class="dashboard-container cursor-pointer bg-yellow-900 md:bg-transparent" 
             id="appointment-anytime">
            <div class="dashboard-icon-container md:bg-yellow-900">
                <ion-icon name="calendar" class="dashboard-icon" ></ion-icon>
            </div>
            <div class="dashboard-text-container" >
                <h1 class="dashboard-title" id="totalAppointAll">
                </h1>
                <div class="animate-appointment-count text-animation-container">
                    <div class="text-animation"></div>
                    <div class="text-animation w-3/6"></div>
                     <div class="text-animation w-6/6"></div>
                </div>
                <h1 class="dashboard-label">Total Appointment</h1>
            </div>
        </div>
    </div>

    <div class="employees grid  grid gap-2 grid-cols-2 mt-2 xl:grid-cols-4">
        <div class="dashboard-container">
            <div class="dashboard-icon-container ">
                <ion-icon name="person" class="dashboard-icon" ></ion-icon>
            </div>
            <div class="dashboard-text-container">
                <h1 class="dashboard-title" id="totalDoctor"></h1>
                <div class="animate-employee-count text-animation-container">
                    <div class="text-animation"></div>
                    <div class="text-animation w-3/6"></div>
                     <div class="text-animation w-6/6"></div>
                </div>
                <h1 class="dashboard-label">Doctors</h1>
            </div>
        </div>

        <div class="dashboard-container">
            <div class="dashboard-icon-container">
                <ion-icon name="people" class="dashboard-icon" ></ion-icon>
            </div>
            <div class="dashboard-text-container" >
                <h1 class="dashboard-title" id="totalPatient"></h1>
                <div class="animate-employee-count text-animation-container">
                    <div class="text-animation"></div>
                    <div class="text-animation w-3/6"></div>
                     <div class="text-animation w-6/6"></div>
                </div>
                <h1 class="dashboard-label">Nurses</h1>
            </div>
        </div>

        <div class="dashboard-container" >
            <div class="dashboard-icon-container" >
                <ion-icon name="desktop" class="dashboard-icon" ></ion-icon>
            </div>
            <div class="dashboard-text-container" >
                <h1 class="dashboard-title" id="totalAdmin">
                </h1>
                <div class="animate-employee-count text-animation-container">
                    <div class="text-animation"></div>
                    <div class="text-animation w-3/6"></div>
                     <div class="text-animation w-6/6"></div>
                </div>
                <h1 class="dashboard-label">Technical Staffs</h1>
            </div>
        </div>

        <div class="dashboard-container">
            <div class="dashboard-icon-container">
                <ion-icon name="walk" class="dashboard-icon" ></ion-icon>
            </div>
            <div class="dashboard-text-container" >
                <h1 class="dashboard-title" id="totalOther">
                </h1>
                <div class="animate-employee-count text-animation-container">
                    <div class="text-animation"></div>
                    <div class="text-animation w-3/6"></div>
                     <div class="text-animation w-6/6"></div>
                </div>
                <h1 class="dashboard-label">Other Employees</h1>
            </div>
        </div>
    </div>
    
     <div class="relative mx-auto w-full md:w-10/12 xl:w-8/12 my-20">
            <canvas id='incomeChart'></canvas>
    </div>
    
    <div class="flex my-20 flex-col xl:flex-row">
        <div class="relative mx-auto w-full md:w-10/12 xl:w-6/12 my-5">
            <canvas id='appointmentChart'></canvas>
        </div>
        <div class="relative mx-auto w-full md:w-10/12 xl:w-6/12 my-5">
            <canvas id='employeeChart'></canvas>
        </div>
    </div>
   
</div>


<script>
    
    function redirectAppointment(appointmentContainer, url){
        $(appointmentContainer).click(function(){
            setMainContent(url);
        });
    }
    
    function getUsersCount(){
        $.ajax({
            url: '/has-roles/dashboardData',
            type: 'get',
            data: null,
            beforeSend: function(request) {
            request.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function(data) {
              var result = JSON.parse(data);
              $('#totalDoctor').html(result.doctor);
              $('#totalPatient').html(result.nurse);
              $('#totalAdmin').html(result.admin);
              $('#totalOther').html(result.other);
              $('.animate-employee-count').remove();
            }
        });
    }
    
    
    function getAppointments(){
        $.ajax({
            url: '/appointments/dashboardAppointmentCount',
            type: 'get',
            data: null,
            beforeSend: function(request) {
            request.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function(data) {
              var result = JSON.parse(data);
              $('#totalAppointAll').html(result.total);
              $('#totalAppointWeek').html(result.week);
              $('#totalAppointToday').html(result.today);
              $('#totalAppointIncoming').html(result.incoming);
              //console.log(result);
              $('.animate-appointment-count').remove();
            }
        });
    }
    
    function themeChange(){
        var themeIcon = $('.theme-icon');
        var darkStatement = 'Are you sure you want <br/> to change to dark mode?';
        var lightStatement = 'Are you sure you want <br/> to change to light mode?';
        
        if($('html').hasClass('dark')){
            $(themeIcon).addClass('justify-start');
        }else{
            $(themeIcon).addClass('justify-end');
        }
        
        $('.theme-change').click(function(){
            if(themeIcon.hasClass('justify-start')){
                Swal.fire({
                    title: lightStatement,
                    icon: 'question',
                    width: 'fit-content',
                    padding: '1.5rem',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, change theme',
                    cancelButtonText: 'Cancel Action'
                  }).then((result) => {
                    if (result.isConfirmed) {
                       $('html').removeClass('dark');
                        themeIcon.removeClass('justify-start');
                        themeIcon.addClass('justify-end');
                        document.cookie = "userTheme= ; expires=Fri, 31 Dec 9999 12:00:00 UTC; path=/";
                    }
                });
            }else{
                Swal.fire({
                    title: darkStatement,
                    icon: 'question',
                    width: 'fit-content',
                    padding: '1.5rem',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, change theme',
                    cancelButtonText: 'Cancel Action'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        $('html').addClass('dark');
                        themeIcon.removeClass('justify-end');
                        themeIcon.addClass('justify-start');
                        document.cookie = "userTheme=dark; expires=Fri, 31 Dec 9999 12:00:00 UTC; path=/";
                    }
                });
            }
        });
    }
    
    var updatingTime = setTimeout(dateTime, 1000);
    function dateTime() {
      var d = new Date();
      date = d.toDateString();
      hour  = d.getHours();
      minute = d.getMinutes();
      if($("#time").is(":visible")){
          $("#time").html(date + ' ' + hour + ':' + minute);
      }
    }
        
    function appointmentStatusBar(){
        $.ajax({
            url: '/appointment-status/statusDashboard',
            type: 'get',
            data: null,
            beforeSend: function(request) {
            request.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function(data) {
                
                var result = JSON.parse(data);
                //console.log(result.statusName);
                
                var ctx = document.getElementById('appointmentChart').getContext('2d');
                var appointmentChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: result.statusName,
                        datasets: [{
                            label: 'Total appointment in all department, according to type',
                            barPercentage: 1,
                            barThickness: 20,
                            maxBarThickness: 20,
                            minBarLength: 2,
                            data: result.statusAppointmentCount,
                            backgroundColor:result.statusColor,
                            borderColor: result.statusColor,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                    }
                });
                
            }
        });
    }
    
    function employeeChart(){
        $.ajax({
            url: '/roles/roles-dashboard',
            type: 'get',
            data: null,
            beforeSend: function(request) {
            request.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function(data) {
                
            var result = JSON.parse(data);
            
            var ctx = document.getElementById('employeeChart').getContext('2d');
            var myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                    data: result.roleCount ,
                    backgroundColor:[
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255,0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(209, 111, 36, 0.5)',
                        'rgba(209, 36, 192, 0.5)',
                        'rgba(71, 0, 0,     0.5)',
                        'rgba(21, 209, 43,  0.5)',
                        'rgba(153, 102, 255,0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        ],
                    borderColor:[
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255,1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(209, 111, 36, 1)',
                        'rgba(209, 36, 192, 1)',
                        'rgba(71, 0, 0,     1)',
                        'rgba(21, 209, 43,  1)',
                        'rgba(153, 102, 255,1)',
                        'rgba(255, 159, 64, 1)',
                        ],
                    
                    }],
                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: result.roleName,
                }
            });
            }
        }); 
    }
    
    function incomeChart(){
        $.ajax({
            url: '/patient-cases/income',
            type: 'get',
            data: null,
            beforeSend: function(request) {
            request.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
            },
            success: function(data) {
                
            var result = JSON.parse(data);
            
            var ctx = document.getElementById('incomeChart').getContext('2d');
            var incomeLineChart = new Chart(ctx, {
                type: 'line',
                data:{
                datasets: [{
                    label: result.currentYearTitle,    
                    data:  result.currentYearDataIncome,
                    backgroundColor:['rgba(0, 68, 255, 0.1)'],
                    borderColor:['rgba(0, 68, 255, 0.3)'],
                    pointBorderColor:[
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255,1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(209, 111, 36, 1)',
                        'rgba(209, 36, 192, 1)',
                        'rgba(71, 0, 0,     1)',
                        'rgba(21, 209, 43,  1)',
                        'rgba(153, 102, 255,1)',
                        'rgba(255, 159, 64, 1)',
                    ],
                    pointBackgroundColor: [
                        'rgba(255, 99, 132, 0.3)',
                        'rgba(54, 162, 235, 0.3)',
                        'rgba(255, 206, 86, 0.3)',
                        'rgba(75, 192, 192, 0.3)',
                        'rgba(153, 102, 255,0.3)',
                        'rgba(255, 159, 64, 0.3)',
                        'rgba(209, 111, 36, 0.3)',
                        'rgba(209, 36, 192, 0.3)',
                        'rgba(71, 0, 0,     0.3)',
                        'rgba(21, 209, 43,  0.3)',
                        'rgba(153, 102, 255,0.3)',
                        'rgba(255, 159, 64, 0.3)',
                        ],
                   
                },
                {
                    label: result.lastYearTitle,    
                    data:  result.lastYearDataIncome,
                    backgroundColor:['rgba(0, 242, 32, 0.1)'],
                    borderColor:['rgba(0, 242, 32, 0.3)'],
                    pointBorderColor:[
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255,1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(209, 111, 36, 1)',
                        'rgba(209, 36, 192, 1)',
                        'rgba(71, 0, 0,     1)',
                        'rgba(21, 209, 43,  1)',
                        'rgba(153, 102, 255,1)',
                        'rgba(255, 159, 64, 1)',
                    ],
                    pointBackgroundColor: [
                        'rgba(255, 99, 132, 0.3)',
                        'rgba(54, 162, 235, 0.3)',
                        'rgba(255, 206, 86, 0.3)',
                        'rgba(75, 192, 192, 0.3)',
                        'rgba(153, 102, 255,0.3)',
                        'rgba(255, 159, 64, 0.3)',
                        'rgba(209, 111, 36, 0.3)',
                        'rgba(209, 36, 192, 0.3)',
                        'rgba(71, 0, 0,     0.3)',
                        'rgba(21, 209, 43,  0.3)',
                        'rgba(153, 102, 255,0.3)',
                        'rgba(255, 159, 64, 0.3)',
                        ],
                    hidden: true,    
                }
                
                ],
                labels: ['January','February','March','April','May', 'June', 'July',
                        'August', 'September', 'October', 'November', 'December'],
                },
                options: {
                    scales: {
                        yAxes: [
                            {
                                ticks: {
                                    beginAtZero: true,
                                    userCallback: function(value, index, values) {
                                        return value.toLocaleString();   // this is all we need
                                    }
                                }
                            }
                        ]
                    },
                    tooltips: {
                    enabled: true,
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(tooltipItems, data) { 
                                var dataTitle = data.datasets[tooltipItems.datasetIndex].label;
                                var year = dataTitle.slice(-4);
                                return year + " : "+tooltipItems.yLabel.toLocaleString();
                            }
                        }
                    },
                },
                
            });
            }
        }); 
    }
    
    
    $(document).ready(function(){
        incomeChart();
        getAppointments();
        getUsersCount();
        redirectAppointment('#appointment-today', '/appointments/departmentApointment/appointment-today');
        redirectAppointment('#appointment-week', '/appointments/departmentApointment/appointment-week');
        redirectAppointment('#appointment-anytime', '/appointments/departmentApointment/appointment-anytime');
        redirectAppointment('#appointment-incoming', '/appointments/departmentApointment/appointment-incoming');
        themeChange();
        appointmentStatusBar();
        employeeChart();
        
    });
</script>   