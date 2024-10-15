<?php
require_once "./autoloader.php";
use app\Models\Login;

if (isset($_POST))
{
    if(isset($_POST['email']) && isset($_POST['pw'])){
        $email = $_POST["email"];
        $pw = $_POST["pw"];
        $login = new Login;
        $result = $login->selectLogin($email, $pw);

    }
}

?>
<form action="" method="POST" class="4/12">
    <fieldset class="flex flex-col gap-1.5">
        <legend class="text-center">Form de Login</legend>

        <div class="flex flex-col gap-0.5">
            <label for="nome">Email</label>
            <input type="email" name="email" id="email" class="p-0.5 text-black rounded-sm w-1/3">
        </div>

        <div class="flex flex-col gap-0.5">
            <label for="nome">Senha</label>
            <input type="password" name="pw" id="pw" class="p-0.5 text-black rounded-sm mb-5 w-1/3">
        </div>

        <button type="submit" class="w-max mx-auto py-1 px-12 bg-slate-500 rounded-sm">Login</button>
    </fieldset>
</form>