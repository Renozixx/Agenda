<?php

namespace app\Models;

require_once "./autoloader.php";

use app\Controllers\CadastroController;
use app\Controllers\ValidadorController;
use app\Controllers\ValidatorController;

class Cadastro extends CadastroController{

    public function create (string $table, array $dados) // Método para inserir um usuário à base de dados e principalmente tratar e validar esse dados
    {
        $colunas = [];
        $valores = [];
        foreach ($dados as $k => $v)
        {
            $colunas[] = $k;
            $valores[$k] = chr(39)."$v".chr(39);
        }
        $val = new ValidadorController();
        $val->validate([ // Método para fazer a validação de campos (qualquer).
            str_replace("'", "", $valores["TELEFONE"]) => "max:10",
            str_replace("'", "", $valores["SENHA"]) => "min:6",
        ]);
        $colunas = implode(", ", $colunas);
        $valores = implode(", ", $valores);
        // $this->createUser($table, $colunas, $valores);
    }

    public function __debugInfo ()
    {
        return [];
    }
}