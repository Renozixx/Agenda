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
        $months = $this->date->getCurrentMonths();
        $daysMonth = $this->date->getDaysInCurrentMonths($months);
        $dayWeek = $this->date->getDayFirstWeekMonth($months);
        $element = "";
        foreach ($daysMonth as $k => $d)
        {
            $element .= "<div class='month justify-items-center items-center gap-1 p-3 bg-slate-800 rounded-sm'>";
            for ($i=0; $i<$dayWeek[$k]; $i++)
            {
                $element .= "<div class=''></div>";
            }
            for ($i=1; $i<=$d; $i++)
            {
                $element  .= "<div class=''>$i</div>";
            }
            $element .= "</div>";
        }
        return $element;
    }
}