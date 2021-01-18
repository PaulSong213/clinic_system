<?php

$roleName = array();
$roleCount = array();

foreach ($roles as $role){
    array_push($roleName, $role->role_name);
    
    $index = 0;
    if (!empty($role->has_roles)){
        foreach ($role->has_roles as $hasRoles){
            $index+=1;
        }
        array_push($roleCount,$index);
    }else{
        array_push($roleCount,$index);
    }
}
$data = array('roleName' => $roleName,'roleCount' => $roleCount);
print_r(json_encode($data));