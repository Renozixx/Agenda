<?php

namespace app\Controllers;
require_once "./autoloader.php";

use src\Request;
class TaskAsideController extends Request {
    public function getDatasUrl ()
    {
        $url = $this->getURL();
        if (strstr($url, ".php"))
        {
            $date = explode(".php/", $url)[1];
            $date = explode("/", $date);
            return [
                "day" => $date[2],
                "month" => $date[1],
                "year" => $date[0],
            ];
        }
    }
}