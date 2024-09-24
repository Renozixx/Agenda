<?php

namespace app\Models;

require_once "./database/database.php";

use app\Controllers\CadastroController;
use app\Controllers\ValidatorController;
class Cadastro extends CadastroController{

    public function create (string $table, array $dados)
    {
        $colunas = [];
        $valores = [];
        foreach ($dados as $k => $v)
        {
            $colunas[] = $k;
            $valores[] = chr(39)."$v".chr(39);
        }
        var_dump($colunas)."<br>";
        var_dump($valores)."<br>";
        $colunas = implode(", ", $colunas);
        $valores = implode(", ", $valores);

        $this->createUser($table, $colunas, $valores);
    }

    public function __debugInfo ()
    {
        return [];
    }
}