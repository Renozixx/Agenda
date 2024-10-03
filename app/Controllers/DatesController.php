<?php
namespace app\Controllers;

use DateTime;

class DatesController {
    private $months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];
    public function getCurrentDate ()
    {
        return [
            "day"=>date("j"),
            "month"=>date("m"),
            "year"=>date("Y"),
        ];
    }

    public function getCurrentMonths ()
    {
        $months = [];
        foreach ($this->months as $v)
        {
            $months[] = intval(date("m", strtotime("$v ".$this->getCurrentDate()["year"])));
        }
        return $months;
    }

    public function getDaysInCurrentMonths (array $months)
    {
        $res = [];
        foreach ($months as $v)
        {
            $res[] = cal_days_in_month(CAL_GREGORIAN, $v, $this->getCurrentDate()["year"]);
        }
        return $res;
    }

    public function getDayFirstWeekMonth (array $months)
    {
        $weeks = [];
        foreach ($this->months as $v)
        {
            $weeks[] = intval(date("w", strtotime("01"."$v ".$this->getCurrentDate()["year"])));
        }
        return $weeks;
    }

}