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

/**
 * Creating date collection between two dates
 *
 * <code>
 * <?php
 * # Example 1
 * date_range("2014-01-01", "2014-01-20", "+1 day", "m/d/Y");
 *
 * # Example 2. you can use even time
 * date_range("01:00:00", "23:00:00", "+1 hour", "H:i:s");
 * </code>
 *
 * @author Ali OYGUR <alioygur@gmail.com>
 *
 * @param string since any date, time or datetime format
 * @param string until any date, time or datetime format
 * @param string step
 * @param string date of output format
 *
 * @return array
 */
function date_range($first, $last, $step = '+1 day', $output_format = 'd/m/Y')
{

    $dates = array();
    $current = strtotime($first);
    $last = strtotime($last);

    while ($current <= $last) {

        $dates[] = date($output_format, $current);
        $current = strtotime($step, $current);
    }

    return $dates;
}

function getRetraso($empleado, $date)
{
    $manual = \App\Manual::where('empleado', $empleado->nombre)
        ->whereDate('created_at', $date)
        ->with('motivo')->first();
    if(!$manual)
    {
        return null;
    }
    return $manual;

}
