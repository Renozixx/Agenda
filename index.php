<?php
require_once "./autoloader.php";

use app\Models\Cadastro;

$db = new Cadastro();
// Aqui, vamos pegar esse nomes de um formulário via POST, esses são apenas teste
$db->create("users", [
    "NOME" => "hugo",
    "EMAIL" => "hugogmail.com",
    "TELEFONE" => "1299999999",
    "SENHA" => "123456",
]);