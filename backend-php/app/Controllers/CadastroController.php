<?php

namespace app\Controllers;

require_once "./autoloader.php";

use database\Database;
class CadastroController extends Database {
    protected function createUser (string $table, $colunas, $valores)
    {
        $this->insert($table, $colunas, $valores);
    }

    public function __debugInfo ()
    {
        return [];
    }
}