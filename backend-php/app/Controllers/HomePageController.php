<?php
namespace App\Controllers;

class HomePageController
{
    private const BASE_URL = 'http://localhost:8000/resources/views/month.php';
    private const DAY_CLASS = 'day flex justify-center items-center w-full text-white rounded-full cursor-pointer transition aspect-square';
    private const MONTH_CLASS = 'month grid-month justify-items-center items-center gap-1 w-full p-3 bg-slate-800 aspect-square rounded';

    private DatesController $datesController;

    public function __construct(DatesController $datesController)
    {
        $this->datesController = $datesController;
    }

    public function genElements(): string
    {
        return $this->genMonths();
    }

    private function genDays(int $month, int $qtd): string
    {
        $currentDate = $this->datesController->getCurrentDate();
        $currentDay = $currentDate["day"];
        $currentMonth = $currentDate["month"];
        $currentYear = $currentDate["year"];
        
        $element = "";
        for ($i = 1; $i <= $qtd; $i++) {
            $class = self::DAY_CLASS;
            if ($month == $currentMonth && $i == $currentDay) $class .= " bg-slate-600";
            $url = $this->generateMonthUrl($currentYear, $month, $i);
            $element .= "<div class='$class' onClick={visibleMonth}>{$i}</div>";
        }
        return $element;
    }

    private function genMonths(): string
    {
        $months = $this->datesController->getCurrentMonths();
        $daysMonth = $this->datesController->getDaysInCurrentMonths($months);
        $dayWeek = $this->datesController->getDayFirstWeekMonth($this->datesController->months);
        
        $element = "";
        foreach ($daysMonth as $k => $d) {
            $element .= "<div class='" . self::MONTH_CLASS . "'>";
            $element .= str_repeat("<div class=''></div>", $dayWeek[$k]);
            $element .= $this->genDays($k + 1, $d);
            $element .= "</div>";
        }
        return $element;
    }

    private function generateMonthUrl(int $year, int $month, int $day): string
    {
        return self::BASE_URL . "/$year/$month/$day";
    }
}