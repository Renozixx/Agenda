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
        $currentDay = $this->date->getCurrentDate();
        $months = $this->date->getCurrentMonths();
        $daysMonth = $this->date->getDaysInCurrentMonths($months);
        $dayWeek = $this->date->getDayFirstWeekMonth($months);
        $element = "";
        foreach ($daysMonth as $k => $d)
        {
            $element .= "<div class='month grid justify-items-center items-center gap-1 w-max p-3 bg-slate-800 rounded-sm'>";
            for ($i=0; $i<$dayWeek[$k]; $i++)
            {
                $element .= "<div class=''></div>";
            }
            for ($i=1; $i<=$d; $i++)
            {
                $class = "day flex justify-center items-center w-full rounded-full hover:bg-slate-500";
                if ($k == $currentDay["month"] and $i == $currentDay["day"]) $class .= " bg-slate-600";
                $class .= " cursor-pointer ease-in-out duration-75 aspect-square";
                $element  .= "<form action='/resources/views/month.php' method='post' class='w-full'> <input type='hidden' name='y' value=".$currentDay["year"]."> <input type='hidden' name='m' value='$k'> <button type='submit' class='$class'>$i</button> </form>";
            }
            $element .= "</div>";
        }
        return $element;
    }
}