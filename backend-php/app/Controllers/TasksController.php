<?php

namespace App\Controllers;

use Database\Database;

class TasksController extends Database {
    protected function returnTasks(): array
    {
        return $this->select("*", "personal_activities");
    }

    protected function insertTask(array $valores): void
    {
        $this->insert("personal_activities", "title, description, date, time, users_id_users", $valores);
    }
}