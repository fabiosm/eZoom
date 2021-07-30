<?php
// Converte data para DB: 
function dataDB($data){    
    $data = explode('-', $data);
    if(isset($data[2]) && isset($data[1]) && isset($data[0])){
        $data = $data[2].'-'.$data[0].'-'.$data[1];
    }else{
        $data = NULL;
    }    
    return($data);
}

// Valida data
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}