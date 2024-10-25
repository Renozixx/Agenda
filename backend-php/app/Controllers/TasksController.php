<?php

namespace app\Controllers;

require_once "./autoloader.php";

use database\Database;

class TasksController extends Database{
    private $tasks;

    protected function returnTasks ()
    {
        return $this->select("*", "personal_activities");
    }
}