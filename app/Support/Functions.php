<?php

function clearEmptyArrays(array $array){
    foreach ($array as $key => &$value) {
        if (empty($value)) {
            unset($array[$key]);
        } else {
            if (is_array($value)) {
                $value = clearEmptyArrays($value);
                if (empty($value)) {
                    unset($array[$key]);
                }
            }
        }
    }
    return $array;
}