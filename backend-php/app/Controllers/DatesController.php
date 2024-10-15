<?php
namespace app\Controllers;

use DateTime;

class DatesController {
    public $daysWeek = [
        "Sabado",
        "Segunda-Feira",
        "Terça-Feira",
        "Quarta-Feira",
        "Quinta-Feira",
        "Sexta-Feira",
        "Domingo",
    ];
    public $months = [
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
            "day"=>date("j"), // Retorna de 1 a 31
            "month"=>date("m"), // Retorna de 01 a 12
            "year"=>date("Y"), // Retorna com 4 digitos: 0000
        ];
    }

    public function getCurrentMonths () // Retorna um array de inteiros correspondente ao mês. Ex: 1 => Janeiro, 2 => Fevereiro, etc.
    {
        $months = [];
        foreach ($this->months as $v) $months[] = intval(date("m", strtotime("$v ".$this->getCurrentDate()["year"])));
        return $months;
    }

    public function getDaysInCurrentMonths (array $months)
    {
        $res = [];
        foreach ($months as $v) $res[] = cal_days_in_month(CAL_GREGORIAN, $v, $this->getCurrentDate()["year"]);
        return $res;
    }

    public function getDayFirstWeekMonth (array $months)
    {
        $weeks = [];
        foreach ($months as $v) $weeks[] = intval(date("w", strtotime("01"." $v ".$this->getCurrentDate()["year"])));
        return $weeks;
    }

}