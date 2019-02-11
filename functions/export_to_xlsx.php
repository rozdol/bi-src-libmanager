<?php

$row=[
    'COMPANY CODE' => "789",
    'JOURNAL CODE' => "JRF",
    'POSTING PERIOD' => "2019",
    'ACCOUNT CODE' => "234",
    'REFERENCE' => "Int",
    'TRANSACTION DATE' => "01.01.2019",
    'SIGN' => "DR",
    'CURRENCY' => "EUR",
    'CURRENCY RATE' => '$rate',
    'FOREIGN AMOUNT' => '$interst_bal',
    'ALLOCATED' => "0",
    'LOCAL AMOUNT' => '$interst_bal_local',
    'ALLOCATED ' => "0",
    'DETAILS' => "Being Interest ".$this->dates->F_date($date,1),
    'T1' => "",
    'T2' => "",
    'T3' => "",
    'T4' => "",
    'T5' => "",
    'T6' => "",
    'T7' => "",
    'T8' => "",
    'T9' => "",
    'T10' => "",
    'VAT CODE' => "",
    'VAT RATE' => "0",
    'VAT AMOUNT' => "0",
    'DUE DATE' => $transaction_date,
    '' => "",
    ' ' => "",
    '  ' => "",
    '   ' => "",
    'IMPORT STATUS' => "4",
    '     ' => "ACCOUNTS"
];
$data[]=$row;
$row['ACCOUNT CODE']='$account_code';
$row['SIGN']='$sign2';
$row['T1']="";

$data[]=$row;
foreach ($row as $key => $value) {
    $row[$key]='';
}
$row['COMPANY CODE']="**********";
$data[]=$row;

end($data);
$key = key($data);

$data = array($key => $data[$key]) + $data;


return $data;