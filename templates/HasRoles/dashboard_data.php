<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$totalAdmin = 0;
$totalNurse = 0;
$totalDoctor = 0;
$totalOther = 0;
foreach ($hasRoles as $hasRole){
    switch ($hasRole->role->role_name) {
        case 'Technical Staff':
            $totalAdmin++;
            break;

        case 'Nurse':
            $totalNurse++;
            break;

        case 'Doctor':
            $totalDoctor++;
            break;
        default:
            $totalOther++;
            break;
    }

}

$listEmployee = array('admin' => $totalAdmin, 'nurse' => $totalNurse,
    'doctor' => $totalDoctor,'other' => $totalOther);

print_r(json_encode($listEmployee));
