<?php

include("../functionsAll.php");

if (isset($_REQUEST["inpEmail"]) && isset($_REQUEST["inpSenha"])) {

    $EMAIL = $_REQUEST["inpEmail"];
    $SENHA = $_REQUEST["inpSenha"];

    if ($EMAIL != "" && $SENHA != "") {

        $return = verificar_usuario($EMAIL, $SENHA);

        foreach ($return as $r) {

            if ($r["EMAIL"] != "" && $r["SENHA"] != "") {

                $EMAILUSER = $r["EMAIL"];
                $IDUSER = $r["ID"];

                session_start();

                $_SESSION["EMAILUSER"] = $EMAILUSER;
                $_SESSION["IDUSER"] = $IDUSER;

                header("location: ../");
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./ASSETS/css/styles.css">

</head>

<body>

    <main class="main">

        <article class="main__article">

            <form action="" method="post" class="main__article__form">

                <fieldset class="main__article__form__fieldset">

                    <legend>LOGIN</legend>

                    <label for="inpEmail" class="main__article__form__fieldset__label">Seu E-Mail</label>
                    <input type="text" name="inpEmail" id="inpEmail" class="main__article__form__fieldset__input">

                    <label for="inpSenha" class="main__article__form__fieldset__label">Sua Senha</label>
                    <input type="text" name="inpSenha" id="inpSenha" class="main__article__form__fieldset__input">

                    <input type="submit" value="Entrar">

                </fieldset>

            </form>

        </article>

    </main>

</body>

</html>