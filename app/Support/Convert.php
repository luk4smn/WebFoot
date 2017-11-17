<?php

namespace App\Support;

use Carbon\Carbon;

class Convert
{
    public static function moneyToDecimal($money){
        return self::getfloat($money,'R$ ');
    }

    public static function volumeToDecimal($money){
        return self::getfloat($money,' m³');
    }

    public static function decimalToMoney($decimal){
        try {
            return number_format($decimal, 2, ',', '.');
        } catch (\Exception $exception) {
            return $decimal;
        }
    }

    public static function dateToDBFormat($brDate){
        try {
            if(empty($brDate)){
                return null;
            }else{
                return Carbon::createFromFormat("d/m/Y", trim($brDate))->toDateString();
            }
        } catch (\Exception $e) {
            return $brDate;
        }
    }

    public static function DBToCarbonFormat($bdDate){
        try {
            if (strstr($bdDate, '-'))
                return Carbon::parse($bdDate);

            return $bdDate;
        } catch (\Exception $e) {
            return $bdDate;
        }
    }

    public static function DBDateTimeToStringFormat($bdDate){
        try{
            if(strstr($bdDate, '-'))
                return Carbon::parse($bdDate)->format('d/m/Y H:i:s');

            if(strstr($bdDate, '/'))
                return Carbon::createFromFormat('d/m/Y H:i:s', $bdDate);

            return $bdDate;
        } catch (\Exception $e) {
            return $bdDate;
        }
    }

    public static function DBDateToStringFormat($bdDate){
        try{
            if(strstr($bdDate, '-'))
                return Carbon::parse($bdDate)->format('d/m/Y');

            return $bdDate;
        } catch (\Exception $e) {
            return $bdDate;
        }
    }

    public static function dateTimeToDBFormat($brDateTime){
        try{
            if(preg_match("/(\d{2})\/(\d{2})\/(\d{4}) (\d{2}):(\d{2}):(\d{2})/", trim($brDateTime))){
                return Carbon::createFromFormat("d/m/Y H:i:s", trim($brDateTime))->toDateTimeString();
            } else if (preg_match("/(\d{2})\/(\d{2})\/(\d{4}) (\d{2}):(\d{2})/", trim($brDateTime))){
                return Carbon::createFromFormat("d/m/Y H:i", trim($brDateTime))->toDateTimeString();
            } return $brDateTime;
        } catch (\Exception $e){
            return $brDateTime;
        }
    }

    public static function removeMascara($campo){
        $array = ['(', ')', '-', '.', '/', ' '];

        try {
            return str_replace($array, "", $campo);

        } catch (\Exception $e) {
            return $campo;
        }
    }

    public static function Mask($mask,$str){
        $str = str_replace(" ","",$str);

        for($i=0;$i<strlen($str);$i++){
            $mask[strpos($mask,"#")] = $str[$i];
        }

        return $mask;
    }

    public static function validateBRDate($value){
        try{

            $br_date = self::dateToDBFormat($value);

            $datetime = new \DateTime();

            $isValid = $datetime->modify($br_date);

            if($isValid->format('d/m/Y') === $value)
                return true;

        } catch (\Exception $e){
            return false;
        }

        return false;
    }

    public static function validateBRDateTime($value){
        try{
            $br_datetime = self::dateTimeToDBFormat($value);

            $datetime = new \DateTime();

            $isValid = $datetime->modify($br_datetime);

            if($isValid->format('Y-m-d H:i:s') === $value)
                return true;

        } catch (\Exception $e){
            return false;
        }

        return false;
    }

    public static function formatBytes($bytes){
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public static function getfloat($str,$unity){
        $str = str_replace($unity, '', $str);

        if (strstr($str, ",")) {
            $str = str_replace(".", "", $str); // replace dots (thousand seps) with blancs
            $str = str_replace(",", ".", $str); // replace ',' with '.'
        }

        if (preg_match('#([0-9\.]+-)#', $str, $match)) { // search for number that may contain '.'
            return floatval($match[0]);
        } else {
            return floatval($str); // take some last chances with floatval
        }
    }
}
