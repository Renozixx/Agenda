<?php

namespace app\Models;

require_once "./autoloader.php";

use app\Controllers\TasksController;

class Tasks extends TasksController {
    public function getTasks ()
    {
        return $this->returnTasks();
    }
}