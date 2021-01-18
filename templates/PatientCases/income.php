<?php
date_default_timezone_set('Asia/Manila');
$currentYear = date("Y");
$formatedIncomeMonthCurrentYear = array();
$formatDataIncomeCurrentYear = array();
$formatTitleCurrentYear = "Current Year's monthly income - ".$currentYear;

$lastYear = date('Y',(strtotime ( '-1 year' , strtotime ( $currentYear) ) ));
$formatedIncomeMonthLastYear = array();
$formatDataIncomeLastYear = array();
$formatTitleLastYear = "Last Year's monthly income - ".$lastYear;
 
foreach ($patientCases as $patientCase){
    $year = date_format($patientCase->start_time, 'Y');
    if($year === $currentYear){
        $month = idate('m', strtotime($patientCase->start_time));
        $format = $patientCase->amount_paid.'*'.$month.'*'.$year;
        array_push($formatedIncomeMonthCurrentYear, $format);
    }else if($year === $lastYear){
        $month = idate('m', strtotime($patientCase->start_time));
        $format = $patientCase->amount_paid.'*'.$month.'*'.$year;
        array_push($formatedIncomeMonthLastYear, $format);
    }
    
}


for($index = 0; $index < 12; $index++){
    $formatDataIncomeCurrentYear[$index] = 0;
    $formatDataIncomeLastYear[$index] = 0;
}

for ($index = 0; $index < count($formatedIncomeMonthCurrentYear); $index++) {
    $fullCurrent =  explode('*', $formatedIncomeMonthCurrentYear[$index]);
    $monthCurrent = $fullCurrent[1] - 1;
    $formatDataIncomeCurrentYear[$monthCurrent] += $fullCurrent[0];
    
   
}
for ($index = 0; $index < count($formatedIncomeMonthLastYear); $index++) {
    $fullLast =  explode('*', $formatedIncomeMonthLastYear[$index]);
    $monthLast = $fullLast[1] - 1;
    $formatDataIncomeLastYear[$monthLast] += $fullLast[0];
}



$listIncome = array('currentYearDataIncome' => $formatDataIncomeCurrentYear,
    'currentYearTitle' => $formatTitleCurrentYear, 'lastYearDataIncome' => $formatDataIncomeLastYear,
    'lastYearTitle' => $formatTitleLastYear);
print_r(json_encode($listIncome));