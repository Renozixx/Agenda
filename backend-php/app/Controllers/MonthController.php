<?php
namespace App\Controllers;

use App\Controllers\DatesController;
class MonthController extends DatesController {
    private const BASE_URL = 'http://localhost:8000/resources/views/month.php';
    private const DAY_CLASS = "day flex justify-center items-center w-full h-full rounded transition cursor-pointer";
    private const MONTH_CLASS = "month grid-month justify-items-center items-center gap-4 w-full h-full p-3 bg-slate-800";

    private DatesController $datesController;

    public function __construct (DatesController $datesController)
    {
        $this->datesController = $datesController;
    }

    public function genElement ()
    {
        return $this->genMonth();
    }

    private function genDays ($month, $qtd)
    {
        $currentDate = $this->datesController->getCurrentDate();
        $currentDay = $currentDate["day"];
        $currentMonth = $currentDate["month"];
        $currentYear = $currentDate["year"];
        $element = "";
        for ($i=1; $i<=$qtd; $i++)
        {
            $class = self::DAY_CLASS;
            if ($month == $currentMonth and $i == $currentDay) $class .= " bg-slate-600";
            $url = $this->generateMonthUrl($currentYear, $currentMonth, $i);
            $element  .= "<div class='$class'>$i</div>";
        }
        return $element;
    }

    private function genWeekDays ()
    {
        $daysWeek = array_map(function ($v){
            return substr($v, 0, 3);
        }, $this->datesController->daysWeek);

        $elements = "";
        foreach ($daysWeek as $d) $elements .= "<div class='flex justify-center'>".$d."</div>";
        return $elements;
    }

    private function genMonth ()
    {
        $currentDate = $this->getCurrentDate();
        $month = $currentDate["month"]; // Pega o mês na forma de número
        $daysMonth = $this->datesController->getDaysInCurrentMonths([$month]);
        $month = $this->datesController->months[$currentDate["month"]-1]; // Pega o mês na forma escrita
        $dayWeek = $this->datesController->getDayFirstWeekMonth([$month]);
        $month = $currentDate["month"]; // Pega o mês na forma de número
        
        $element = "";
        foreach ($daysMonth as $k => $d)
        {
            $class = self::MONTH_CLASS;
            $element .= "<div class='$class'>";
            $element .= $this->genWeekDays();
            $element .= str_repeat("<div class=''></div>", $dayWeek[$k]);
            $element .= $this->genDays($month, $d);
            $element .= "</div>";
        }
        return $element;
    }

    private function getDateUrl ()
    {
        $uri = $_SERVER["REQUEST_URI"];
        if (strstr($uri, ".php"))
        {
            $datesController = explode(".php/", $uri)[1];
            $datesController = explode("/", $datesController);
            return [
                "day" => $datesController[2],
                "month" => $datesController[1],
                "year" => $datesController[0],
            ];
        }
    }

    private function generateMonthUrl(int $year, int $month, int $day): string
    {
        return self::BASE_URL . "/$year/$month/$day";
    }
}