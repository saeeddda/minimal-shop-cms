<?php

use Morilog\Jalali\Jalalian;

function jalaliDate($date, $format = '%A, %d %B %Y'){
    return Jalalian::forge($date)->format($format);
}

function convertByteToSizeName($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }

    return $bytes;
}

function convertSizeNameToByte(string $from) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
    $number = substr($from, 0, -2);
    $suffix = strtoupper(substr($from,-2));

    //B or no suffix
    if(is_numeric(substr($suffix, 0, 1))) {
        return preg_replace('/[^\d]/', '', $from);
    }

    $exponent = array_flip($units)[$suffix] ?? null;
    if($exponent === null) {
        return null;
    }

    return $number * (1024 ** $exponent);
}

function convertPersianNumToEnglishNum($number){
    $number = str_replace('۰', '0', $number);
    $number = str_replace('۱', '1', $number);
    $number = str_replace('۲', '2', $number);
    $number = str_replace('۳', '3', $number);
    $number = str_replace('۴', '4', $number);
    $number = str_replace('۵', '5', $number);
    $number = str_replace('۶', '6', $number);
    $number = str_replace('۷', '7', $number);
    $number = str_replace('۸', '8', $number);
    $number = str_replace('۹', '9', $number);
    return $number;
}

function convertEnglishNumToPersianNum($number){
    $number = str_replace('0','۰' , $number);
    $number = str_replace('1','۱', $number);
    $number = str_replace('2','۲', $number);
    $number = str_replace('3','۳', $number);
    $number = str_replace('4','۴', $number);
    $number = str_replace('5','۵', $number);
    $number = str_replace('6','۶', $number);
    $number = str_replace('7','۷', $number);
    $number = str_replace('8','۸', $number);
    $number = str_replace('9','۹', $number);
    return $number;
}

function priceFormat($price, $decimalCount = 0, $slashPointer = '/', $decimalPointer = ','){
    return convertEnglishNumToPersianNum( number_format($price, $decimalCount, $slashPointer, $decimalPointer) );
}

function validateNationalCode($code){
    $code = trim($code,'.');
    $code = convertPersianNumToEnglishNum($code);

    $invalidCodes = [
        '0000000000',
        '1111111111',
        '2222222222',
        '3333333333',
        '4444444444',
        '5555555555',
        '6666666666',
        '7777777777',
        '8888888888',
        '9999999999',
    ];

    if(empty($code)) return false;
    if( count(str_split($code)) != 10) return false;
    if(in_array($code, $invalidCodes)) return false;

    $sum = 0;

    for($i = 0; $i < 9; $i++){
        $sum += (int) $code[$i] * (10 -$i);
    }

    $dividedCode = $sum % 11;

    if($dividedCode < 2){
        $lastDigits = $dividedCode;
    }else{
        $lastDigits = 11 - $dividedCode;
    }

    if((int) $code[9] == $lastDigits){
        return true;
    }else{
        return false;
    }
}
