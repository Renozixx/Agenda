<?php

namespace App\Models;

use App\Controllers\CadastroController;
use App\Controllers\ValidadorController;
use Exception;

class Cadastro extends CadastroController{

    public function create (string $table, array $dados)
    {
        if ((empty($table) or !$table) or (empty($dados) or !$table))
        {
            return FALSE;
        }

        $colunas = [];
        $valores = [];
        foreach ($dados as $k => $v)
        {
            $colunas[$k] = $k;
            $valores[$k] = $v;
        }

        $val = $this->validate($valores);
        if ($val)
        {
            return $val;
        }
        
        $result = $this->select($colunas['email'], "users", " WHERE " . $colunas['email'] . " = '" . $valores["email"] . "'");
        if ($result)
        {
            return FALSE;
        }
        
        $colunas = implode(", ", $colunas);
        $this->createUser($table, $colunas, $valores);
    }

    /**
     * Valida cada campo de entrada do formulário
     * @param array $valores
     */
    private function validate($valores)
    {
        $val = new ValidadorController();
        $val = $val->validate([
            str_replace("'", "", $valores["username"]) => "required",
            str_replace("'", "", $valores["email"]) => "mail,required",
            str_replace("'", "", $valores["phone"]) => "max:11,required",
            str_replace("'", "", $valores["password"]) => "min:6,required",
        ]);

        return $val;
    }

    public function __debugInfo ()
    {
        return [];
    }
}