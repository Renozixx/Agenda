<?php

namespace App\Controllers;
class EnvController {
    public static $instance;
    private static $envFile = [];

    /**
     * Recupera o conteúdo do arquivo de configuração da aplicação
     */
    public function __construct ()
    {
        $this->loadEnvFile();
    }

    private function loadEnvFile(): void
    {
        $file = fopen(".env", "r");
        if ($file === false) {
            throw new \Exception("Não foi possível abrir o arquivo .env");
        }
        rewind($file);
        
        while (($line = fgets($file)) !== false) {
            if (!empty(trim($line))) {
                $this->parseEnvLine($line);
            }
        }
        fclose($file);
    }

    private function parseEnvLine(string $line): void
    {
        $line = explode("=", $line);
        if (count($line) === 2) {
            self::$envFile[trim($line[0])] = trim($line[1]);
        }
    }

    private function getInstance ()
    {
        if (self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getEnvFile(): array
    {
        $this->getInstance();
        return self::$envFile;
    }
    
}