<?php

namespace database;

require_once "./autoloader.php";

use mysqli;
use app\Controllers\EnvController;
class Database extends EnvController {
    protected $env;
    protected $mysqli;

    public function getEnv ()
    {
        return $this->env = $this->getEnvFile();
    }

    private function openConnection ()
    {
        $varDB = $this->getEnvFile();
        $varDBHOST = $varDB["DB_HOSTNAME"];
        $varDBUSER = $varDB["DB_USERNAME"];
        $varDBPASS = $varDB["DB_PASSWORD"];
        $varDBNAME = $varDB["DB_NAME"];
        $this->mysqli = new mysqli($varDBHOST, $varDBUSER, $varDBPASS, $varDBNAME);
        if ($this->mysqli->connect_errno)
        {
            return $this->mysqli->connect_error;
        }else
        {
            return 1;
        }
    }

    protected function insert (string $table, string $colunas, string $valores)
    {
        $this->openConnection();

        $query = "INSERT INTO $table (".$colunas.") VALUES (".$valores.")";
        var_dump($query);
        $this->mysqli->query($query);

        $this->closeConnection();
    }

    private function closeConnection ()
    {
        if($this->mysqli->close())
        {
            return 1;
        }
    }
}