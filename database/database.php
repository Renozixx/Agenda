<?php
require_once "./app/Controllers/EnvController.php";
class Database {
    protected $env;
    public function getEnv ()
    {
        $this->env = new Env();
        return $this->env->getEnvFile();
    }
    public function insert ()
    {

    }
}