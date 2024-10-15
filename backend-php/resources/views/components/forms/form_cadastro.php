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
    $cadastro = $cadastro->create("users", [
        "NOME" => $nome,
        "EMAIL" => $email,
        "TELEFONE" => $tel,
        "SENHA" => $pw,
    ]);
}
?>
<form action="" method="post" class="w-4/12">
    <fieldset class="flex flex-col gap-1.5">
        <legend></legend>

        <div class="flex flex-col gap-0.5">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="p-0.5 text-black rounded-sm">
        </div>

        <div class="flex flex-col gap-0.5">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="p-0.5 text-black rounded-sm">
        </div>

        <div class="flex flex-col gap-0.5">
            <label for="tel">Telefone</label>
            <input type="number" name="tel" id="tel" class="p-0.5 text-black rounded-sm">
        </div>

        <div class="flex flex-col gap-0.5">
            <label for="pw">Senha</label>
            <input type="password" name="pw" id="pw" class="p-0.5 text-black rounded-sm">
        </div>

        <button type="submit" class="w-max mx-auto py-1 px-12 bg-slate-500 rounded-sm">Cadastrar</button>
        <div class="erros flex flex-col gap-1 justify-center">
            <?php
            if (isset($cadastro)) foreach ($cadastro as $v) echo "<p class='mx-auto'>$v</p><br>";
            ?>
        </div>
    </fieldset>
</form>