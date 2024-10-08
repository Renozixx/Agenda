<?php
namespace app\Controllers;
require_once "./autoloader.php";

use app\Controllers\DatesController;

class HomePageController {
    private $date;

    public function __construct ()
    {
        $this->date = new DatesController;
    }

    public function genElements ()
    {
        return $this->genMonths();
    }

    private function genDays ($month, $qtd)
    {
        $currentDate = $this->date->getCurrentDate();
        $currentDay = $currentDate["day"];
        $currentMonth = $currentDate["month"];
        $currentYear = $currentDate["year"];
        
        $element = "";
        for ($i=1; $i<=$qtd; $i++)
        {
            $class = "day flex justify-center items-center w-full rounded-full hover:bg-slate-500";
            if ($month == $currentMonth and $i == $currentDay) $class .= " bg-slate-600";
            $class .= " cursor-pointer ease-in-out duration-75 aspect-square";

            $element  .= "<div class='$class' onclick='redirect.sendGET(`http://localhost:8000/resources/views/month.php`, [".$currentYear.", ".$month.", ".$i."])'>$i</div>";
        }
        return $element;
    }

    private function genMonths ()
    {
        $months = $this->date->getCurrentMonths();
        $daysMonth = $this->date->getDaysInCurrentMonths($months);
        $dayWeek = $this->date->getDayFirstWeekMonth($this->date->months);
        
        $element = "";
        foreach ($daysMonth as $k => $d)
        {
            $class = "month grid justify-items-center items-center gap-1 w-max p-3 bg-slate-800 rounded-sm";
            $element .= "<div class='$class'>";
            for ($i=0; $i<$dayWeek[$k]; $i++)
            {
                $element .= "<div class=''></div>";
            }
            
            $element .= $this->genDays($k+1, $d);
            $element .= "</div>";
        }
        return $element;
    }
}