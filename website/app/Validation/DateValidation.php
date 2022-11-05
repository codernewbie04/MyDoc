<?php

namespace App\Validation;

class DateValidation
{
	public function date_valid($date){
        $year =  (int) substr($date, 0, 4);
        $month =  (int) substr($date, 5, 2);
        $day = (int) substr($date, 8, 9);
        return checkdate($month, $day, $year);
    }
}