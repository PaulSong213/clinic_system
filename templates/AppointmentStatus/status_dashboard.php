<?php
$statusName = array();
$statusAppointmentCount = array();
$statusColor = array();

foreach ($appointmentStatus as $appointmentStatus){
    array_push($statusName,$appointmentStatus->status_name );
    array_push($statusColor, $appointmentStatus->status_color);
    $index = 0;
    if (!empty($appointmentStatus->appointments)){
            foreach ($appointmentStatus->appointments as $appointments){
                $index+=1;
            }
            array_push($statusAppointmentCount, $index);
    }else{
         array_push($statusAppointmentCount, $index);
    }
}
$data = array('statusName' => $statusName, 'statusAppointmentCount' => $statusAppointmentCount,
    'statusColor' => $statusColor);
print_r(json_encode($data));