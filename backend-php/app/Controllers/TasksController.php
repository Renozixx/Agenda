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

    protected function insertTask ($valores)
    {
        $this->insert("personal_activities", "title, description, date, time, users_id_users", $valores);
    }
}