<?php
require_once "./app/Controllers/EnvController.php";
class Database {
    protected $env;
    public function getEnv ()
    {
        $this->env = new Env();
        return $this->env->getEnvFile();
    }
    public function connect (): mysqli
    {
        $this->env = new Env();
        $array = $this->env->getEnvFile();
        $dbname = $array['DB_NAME'];
        $dbuser = $array['DB_USER'];
        $dbpass = $array['DB_PASSWORD'];
        $dbhost = $array['DB_HOST'];
        $dbport = $array['DB_PORT'];
        
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
    public function insert ()
    {
        
    }
}