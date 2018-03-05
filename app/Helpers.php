<?php

if (!function_exists('isBefore')) {

    function isToBeLate($day, $time)
    {
        return $day > 0
            ? istoBeLateGetIn($day, $time)
            : '';

    }
}


if (!function_exists('isToBeLateGetIn')) {
    function istoBeLateGetIn($day, $time)
    {
        if ($day < 5) {
            if ($time > '08:59:59') {
                return 'table-warning';
            }
        } elseif ($day == 5) {
            if ($time > '07:59:59') {
                return 'table-warning';
            }
        } else {
            return '';
        }
    }
}
