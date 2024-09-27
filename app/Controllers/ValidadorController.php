<?php
namespace app\Controllers;

require_once "./autoloader.php";

use Exception;

// Esse validador serve para validar campos, se o cara colocar por exemplo, uma sena 12345, o que está fora dos nossos
// parametros de segurança, 
class ValidadorController {
    protected $msg = [];
    private $error;

    public function validate ($valor)
    {
        foreach ($valor as $value => $rule)
        {
            if (!is_array($value)) // Verifica se o valor a ser validado não é um array
            {
                $this->processRule($value, $rule);
            }else
            {
                $this->msg[] = "Nenhum valor deve ser um array.";
                $this->error = TRUE;
            }
        }
        if ($this->error) return $this->msg;
    }

    private function processRule ($valor, $rule)
    {
        if (strstr($rule, ",")) // Verifica se existe mais de 1 regra de validação
        {
            $rules = explode(",", $rule);

            foreach ($rules as $kr => $vr)
            {
                $this->handleRule($valor, $vr);
            }
        }else // Ou se há apena 1 regra de validação
        {
            $this->handleRule($valor, $rule);
        }
    }

    private function handleRule ($valor, $rule)
    {
        if (strstr($rule, ":")) // Verifica se a regra possui algum valor
        {
            $rule = explode(":", $rule);
            $validador = $rule[0];
            $validadorValor = $rule[1];
            $this->switchRules($valor, $validador, $validadorValor);
        }else
        {
            $this->switchRules($valor, $rule);
        }
    }

    private function switchRules ($valor, $validador, $valueValidador="") // Método para exibir e tratar cada regra de validação. Aqui podemos criar diversas regras
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
            case "required":
                if (strlen($valor) == 0)
                {
                    $this->msg[] = "O campo $valor é obrigatório";
                    $this->error = TRUE;
                }
                break;
            default:

        }
        return TRUE;
    }
}