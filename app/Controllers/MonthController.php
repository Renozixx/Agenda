<?php
namespace app\Controllers;
require_once "./autoloader.php";

use app\Controllers\DatesController;

class MonthController {
    private $date;

    public function __construct ()
    {
        $this->date = new DatesController;
    }

    public function genElement ()
    {
        return $this->genMonth();
    }

    private function genDays ($month, $qtd)
    {
        $currentDate = $this->date->getCurrentDate();
        $currentDay = $currentDate["day"];
        $currentMonth = $currentDate["month"];

        $element = "";
        for ($i=1; $i<=$qtd; $i++)
        {
            $class = "day flex justify-center items-center w-full h-full rounded hover:bg-slate-500";
            if ($month == $currentMonth and $i == $currentDay) $class .= " bg-slate-600";
            $class .= " cursor-pointer ease-in-out duration-75";
            $element  .= "<div class='$class'>$i</div>";
        }
        return $element;
    }

    private function genWeekDays ()
    {
        $daysWeek = array_map(function ($v){
            return substr($v, 0, 3);
        }, $this->date->daysWeek);

        $elements = "";
        foreach ($daysWeek as $d) $elements .= "<div>".$d."</div>";
        return $elements;
    }

    private function genMonth ()
    {
        $currentDate = $this->getDateUrl();
        $month = $currentDate["month"]; // Pega o mês na forma de número
        $daysMonth = $this->date->getDaysInCurrentMonths([$month]);
        $month = $this->date->months[$currentDate["month"]]; // Pega o mês na forma escrita
        $dayWeek = $this->date->getDayFirstWeekMonth([$month]);
        
        $element = "";
        foreach ($daysMonth as $k => $d)
        {
            $class = "month grid justify-items-center items-center gap-4 h-full p-3 bg-slate-800 rounded-sm";
            $element .= "<div class='$class'>";
            $element .= $this->genWeekDays();
            for ($i=0; $i<$dayWeek[$k]; $i++) $element .= "<div class=''></div>";
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
            $date = explode(".php/", $uri)[1];
            $date = explode("/", $date);
            return [
                "day" => $date[2],
                "month" => $date[1],
                "year" => $date[0],
            ];
        }
    }
}