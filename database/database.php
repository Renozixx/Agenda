<?php
require_once "./app/Controllers/EnvController.php";
class Database extends Env {
    protected $env;
    protected $mysqli;

    public function getEnv ()
    {
        $this->env = new Env();
        return $this->env->getEnvFile();
    }

    public function openConnection ()
    {
        $varDB = $this->getEnvFile();
        $varDBHOST = $varDB["DB_HOSTNAME"];
        $varDBUSER = $varDB["DB_USERNAME"];
        $varDBPASS = $varDB["DB_PASSWORD"];
        $varDBNAME = $varDB["DB_NAME"];
        // var_dump($varDB);
        // var_dump($varDBHOST, $varDBUSER, $varDBPASS, $varDBNAME);
        $this->mysqli = new mysqli($varDBHOST, $varDBUSER, $varDBPASS, $varDBNAME);

        if ($this->mysqli->connect_errno)
        {
            return $this->mysqli->connect_error;
        }else
        {
            return 1;
        }
    }

    public function insert (string $table, array $dados)
    {
        $colunas = [];
        $valores = [];
        foreach ($dados as $k => $v)
        {
            $colunas[] = $k;
            $valores[] = chr(39)."$v".chr(39);
        }
        $colunas = implode(", ", $colunas);
        $valores = implode(", ", $valores);
        $query = "INSERT INTO $table (".$colunas.") VALUES (".$valores.")";
        var_dump($query);
        $this->mysqli->query($query);
    }

    public function closeConnection ()
    {
        if($this->mysqli->close())
        {
            return 1;
        }
    }
}