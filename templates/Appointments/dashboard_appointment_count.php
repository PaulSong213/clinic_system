<?php

date_default_timezone_set('Asia/Manila');
$total = sizeof($appointments);
$today = 0;
$week = 0;
$incoming = 0;

foreach ($appointments as $appointment){
     $dateToday = date('y-m-d', time());
     $dateNextWeek = date('y-m-d', strtotime($dateToday. ' + 7 days'));
     
    if($appointment->appointment_start_time !== null ){
        $appointmentDate = strtotime($appointment->appointment_start_time);
        $newformatAppointmentDate = date('y-m-d',$appointmentDate);
    
      if($dateToday === $newformatAppointmentDate){
         $today++;
      }

      if ( $newformatAppointmentDate >= $dateToday  && 
              $newformatAppointmentDate <= $dateNextWeek ){
          $week++;
      }
      
      if($newformatAppointmentDate >= $dateToday){
          $incoming++;
      }
      
    }
 }
 $listEmployee = array('today' => $today, 'week' => $week,
 'total' => $total,'incoming' => $incoming);
 print_r(json_encode($listEmployee));