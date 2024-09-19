
<?php

include("../functionsAll.php");

if(isset($_REQUEST["inpName"]) && isset($_REQUEST["inpEmail"]) && isset($_REQUEST["inpTel"]) && isset($_REQUEST["inpSenha"])){

    $NOME = $_REQUEST["inpName"];
    $EMAIL = $_REQUEST["inpEmail"];
    $TEL = $_REQUEST["inpTel"];
    $SENHA = $_REQUEST["inpSenha"];

    if($NOME != "" && $EMAIL != "" && $TEL != "" && $SENHA != ""){

        adicionar_usuario($NOME, $EMAIL, $TEL, $SENHA);

    }else{

        echo "Preencha todos os campos!";

    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Agenda</title>

    <link rel="stylesheet" href="./ASSETS/css/styles.css">

</head>
<body>



    <main class="main">

        <article class="main__article">

            <form action="" method="post" class="main__article__form">

                <fieldset class="main__article__form__fieldset">

                    <legend></legend>

                    <label for="inpName" class="main__article__form__fieldset__label">Nome</label>
                    <input type="text" name="inpName" id="inpName" class="main__article__form__fieldset__input">
                    
                    <label for="inpEmail" class="main__article__form__fieldset__label">E-Mail</label>
                    <input type="text" name="inpEmail" id="inpEmail" class="main__article__form__fieldset__input">
                    
                    <label for="inpTel" class="main__article__form__fieldset__label">Telefone</label>
                    <input type="text" name="inpTel" id="inpTel" class="main__article__form__fieldset__input">
                    
                    <label for="inpSenha" class="main__article__form__fieldset__label">Senha</label>
                    <input type="text" name="inpSenha" id="inpSenha" class="main__article__form__fieldset__input">

                    <input type="submit" value="Cadastar" class="main__article__form__fieldset__input">

                </fieldset>

            </form>

        </article>

    </main>
    
</body>
</html>