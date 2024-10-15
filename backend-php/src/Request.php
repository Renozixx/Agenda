<?php

namespace src;
require "./autoloader.php";

class Request {
    public function getURL ()
    {
        return $_SERVER["REQUEST_URI"];
    }
}