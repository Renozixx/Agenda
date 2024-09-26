<?php
require_once "./autoloader.php";
use app\Models\Cadastro;
if(count($_POST) != 0)
{
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $pw = $_POST["pw"];
    $cadastro = new Cadastro;
    $cadastro->create("users", [
        "NOME" => $nome,
        "EMAIL" => $email,
        "TELEFONE" => $tel,
        "SENHA" => $pw,
    ]);
}
?>
<form action="" method="post">
    <fieldset>
        <legend></legend>

        <div>
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome">
        </div>

        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
        </div>

        <div>
            <label for="tel">Telefone</label>
            <input type="number" name="tel" id="tel">
        </div>

        <div>
            <label for="pw">Senha</label>
            <input type="password" name="pw" id="pw">
        </div>

        <button type="submit">Cadastrar</button>
    </fieldset>
</form>