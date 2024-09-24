<?php
namespace app\Controllers;

use Exception;

require_once "./autoloader.php";

class ValidatorController {
    private $msg = [];
    private $error;

    public function validate ($valor)
    {
        foreach ($valor as $value => $rule)
        {
            if (!is_array($value))
            {
                if (!strstr($rule, ",")) // Verifica se há mais de 1 Regra de Validação
                {
                    if (strstr($rule, ":")) // Verifica se a regra tem algum valor
                    {
                        $rule = explode(":", $rule);
                        $validador = $rule[0];
                        $valueValidador = $rule[1];
                        $this->switchRules($value, $validador, $valueValidador); // Precisa de '$valueValidador'
                    }else
                    {
                        $this->switchRules($value, $rule); // Não precisa de '$valueValidador'
                    }
                }else // Verifica se há 2 ou mais Regras de Validação
                {
                    $validadores = explode(",", $rule);
    
                    foreach ($validadores as $k => $v)
                    {
                        if (strstr($v, ":")) // Varificando se cada uma das regras tem algum valor
                        {
                            $v = explode(":", $v);
                            $validador = $v[0];
                            $valueValidador = $v[1];
                            $this->switchRules($value, $validador, $valueValidador);
                        }else
                        {
                            $this->switchRules($value, $v);
                        }
                    }
                }
            }
        }
        if ($this->error)
        {
            $msg = "";
            foreach ($this->msg as $v)
            {
                $msg .= $v.". ";
            }
            throw new Exception("$msg");
        }
    }

    private function switchRules ($valor, $validador, $valueValidador="") // Método para armazenar o switch, pois uso muito ele acima
    {
        switch ($validador)
        {
            case "min":
                if (strlen($valor) < intval($valueValidador))
                {
                    $this->msg[] = "O campo $valor suporta no minímo $valueValidador caracteres";
                    $this->error = TRUE;
                }
                break;
            case "max":
                if (strlen($valor) > intval($valueValidador))
                {
                    $this->msg[] = "O campo $valor suporta no máximo $valueValidador caracteres";
                    $this->error = TRUE;
                }
                break;
            case "str":
                if (!is_string($valor))
                {
                    $this->msg[] = "O campo $valor tem que ser uma string";
                    $this->error = TRUE;
                }
                break;
            case "int":
                if (!is_int($valor))
                {
                    $this->msg[] = "O campo $valor tem que ser um número";
                    $this->error = TRUE;
                }
                break;
            case "mail":
                if (!strstr($valor, "@"))
                {
                    $this->msg[] = "O campo $valor não é um email válido";
                    $this->error = TRUE;
                }
                break;
            default:
                $this->msg[] = "O campo $valor não pode ser NULL";
                $this->error = TRUE;
        }
        return TRUE;
    }
}