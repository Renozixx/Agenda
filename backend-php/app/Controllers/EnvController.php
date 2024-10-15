<?php

namespace app\Controllers;
class EnvController {
    public $envFile = [];

    public function getEnvFile(): array
    {
        $v = [];
        $file = fopen(".env", "r");
        rewind($file);
        while (!feof($file)) $v[] = fgets($file);
        
        foreach ($v as $valor)
        {
            $arr = explode("=", $valor);
            $this->envFile[$arr[0]] = trim($arr[1]);
        }
        return $this->envFile;
    }
    
}