<?php
class Env {
    public $envFile = [];
    public function getEnvFile(): array
    {
        $v = [];
        $file = fopen(".env", "r");
        rewind($file);
        while (!feof($file))
        {
            $v[] = fgets($file);
        };
        foreach ($v as $k => $valor)
        {
            $arr = explode("=", $valor);
            $this->envFile[$arr[0]] = $arr[1];
        }
        return $this->envFile;
    }
}