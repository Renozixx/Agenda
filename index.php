<?php
require_once "./autoloader.php";

use app\Models\Cadastro;

$db = new Cadastro();
$db->create("users", [
    "NOME" => "hugo",
    "EMAIL" => "hugo@gmail.com",
    "TELEFONE" => "1299999999",
    "SENHA" => "123",
]);