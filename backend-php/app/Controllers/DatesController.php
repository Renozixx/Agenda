<?php
namespace App\Controllers;

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

    public function getCurrentDate (): array
    {
        return [
            "day"=>date("j"), // Retorna de 1 a 31
            "month"=>date("m"), // Retorna de 01 a 12
            "year"=>date("Y"), // Retorna com 4 digitos: 0000
        ];
    }

    public function getCurrentMonths (): array
    {
        return array_map(function($month) {
            return intval(date("m", strtotime("$month " . $this->getCurrentDate()["year"])));
        }, $this->months);
    }

    public function getDaysInCurrentMonths (array $months): array
    {
        return array_map(function($month) {
            return cal_days_in_month(CAL_GREGORIAN, $month, $this->getCurrentDate()["year"]);
        }, $months);
    }

    public function getDayFirstWeekMonth (array $months): array
    {
        return array_map(function($month) {
            return intval(date("w", strtotime("01 $month " . $this->getCurrentDate()["year"])));
        }, $months);
    }

}