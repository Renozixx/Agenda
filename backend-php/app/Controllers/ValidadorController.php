<?php
namespace App\Controllers;

/**
 * Classe que valida campos em geral.
 * Ex: max de 3 carcteres, email, etc
 */
class ValidadorController {
    protected $msg = [];
    private $error;

    /**
     * Entrada para tratar os parâmetros passados
     * @param array $valor Valores com o compo e regras paro o campo
     */
    public function validate (array $valor): array
    {
        foreach ($valor as $value => $rule)
        {
            if (!is_array($value))
            {
                $this->processRule($value, $rule);
            }else
            {
                $this->msg[] = "Nenhum valor deve ser um array.";
                $this->error = TRUE;
            }
        }
        
        return $this->error ? $this->msg : [];
    }

    /**
     * Verificamos se existe mais de uma regra para um campo
     */
    private function processRule (string $valor, string $rule): void
    {
        $rules = strpos($rule, ",") !== false ? explode(",", $rule) : [$rule];
        foreach ($rules as $vr)
        {
            $this->handleRule($valor, $vr);
        }
    }

    /**
     * Verificamos se a regra pussui algum valor
     */
    private function handleRule (string $valor, string $rule): void
    {
        if (strpos($rule, ":") !== false)
        {
            [$validador, $validadorValor] = explode(":", $rule);
            $this->switchRules($valor, $validador, $validadorValor);
        }else
        {
            $this->switchRules($valor, $rule);
        }
    }

    private function switchRules (string $valor, string $validador, string $valueValidador = "")
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