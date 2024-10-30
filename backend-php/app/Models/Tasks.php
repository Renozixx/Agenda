<?php

namespace App\Models;

use App\Controllers\TasksController;

class Tasks extends TasksController {
    public function getTasks ()
    {
        return $this->returnTasks();
    }

    public function create ($valores)
    {
        $this->insertTask($valores);
    }
}