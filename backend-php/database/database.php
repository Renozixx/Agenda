<?php

namespace database;

require_once "./autoloader.php";

use mysqli;
use app\Controllers\EnvController;
use Exception;

// Public -> 
// Private -> Nao pode assessar, fora, porem todas as funções do nosso arquivo podem acessar ele
// Protected -> Trabalha em relação a heranças, a classe pai, pode acessar oq está escrito nele, porem o object, ou
// A classe em sí podem acessar ele
class Database extends EnvController {
    protected $env;
    protected $mysqli;

    public function getEnv ()
    {
        return $this->env = $this->getEnvFile();
    }

    protected function openConnection ()
    {
        $varDB = $this->getEnvFile();
        $varDBHOST = $varDB["DB_HOSTNAME"];
        $varDBUSER = $varDB["DB_USERNAME"];
        $varDBPASS = $varDB["DB_PASSWORD"];
        $varDBNAME = $varDB["DB_NAME"];
        $this->mysqli = new mysqli($varDBHOST, $varDBUSER, $varDBPASS, $varDBNAME);
        if ($this->mysqli->connect_errno) return $this->mysqli->connect_error;
        else return 1;
    }

    protected function select (string $colunas, string $table, string $parametros = "")
    {
        try
        {
            $this->openConnection();
            $query = "SELECT $colunas FROM $table $parametros";
            $result = $this->mysqli->query($query);
            $this->closeConnection();
            return $result->fetch_all();
        }catch (Exception $e)
        {
            return $result = TRUE;
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

    protected function closeConnection ()
    {
        if($this->mysqli->close()) return 1;
    }
}