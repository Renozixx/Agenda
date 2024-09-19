<?php

include("functionsAll.php");

session_start();

//Verifica os compos do formulário de login para fazer o login do usuário;
if(isset($_REQUEST["EmailUser"]) && isset($_REQUEST["PswUser"])){

    $EmailUser = $_REQUEST["EmailUser"];
    $PswUser = $_REQUEST["PswUser"];

    if($EmailUser != "" && $PswUser != ""){

        $return = verificar_usuario($EmailUser, $PswUser);

        foreach($return as $r){

            if($r["EMAIL"] != "" && $r["SENHA"] != ""){

                $NOME = $r["NOME"];
                $EMAIL = $r["EMAIL"];
                
                $_SESSION["NOMEUSER"] = $NOME;
                $_SESSION["EMAILUSER"] = $EMAIL;

            }

        }

    }

    header("location: ./");

}

//Verifica os campos do formulário de cadastro de usuários para fazer o cadastro do usuário
if(isset($_REQUEST["NameUser"]) && isset($_REQUEST["EmailUser"]) && isset($_REQUEST["TelUser"]) && isset($_REQUEST["SenhaUser"])){

    $NameUser = $_REQUEST["NameUser"];
    $EmailUser = $_REQUEST["EmailUser"];
    $TelUser = $_REQUEST["TelUser"];
    $SenhaUser = $_REQUEST["SenhaUser"];

    if($NameUser != "" && $EmailUser != "" && $TelUser != "" && $SenhaUser != ""){

        adicionar_usuario($NameUser, $EmailUser, $TelUser, $SenhaUser);

        $NOME = $NameUser;
        $EMAIL = $EmailUser;

        $_SESSION["NOMEUSER"] = $NOME;
        $_SESSION["EMAILUSER"] = $EMAIL;

    }else{

        echo "Preencha todos os campos!";

    }
    
    header("location: ./");

}

//
if(isset($_REQUEST["TitleTask"]) && isset($_REQUEST["DescTask"]) && isset($_REQUEST["HoraTask"]) && isset($_REQUEST["DataTask"])){

    $TitleTask = $_REQUEST["TitleTask"];
    $DescTask = $_REQUEST["DescTask"];
    $HoraTask = $_REQUEST["HoraTask"];
    $DataTask = $_REQUEST["DataTask"];

    if($TitleTask != "" || $DescTask != "" && isset($_SESSION["EMAILUSER"]) && isset($_SESSION["NOMEUSER"])){

        $EMAILUSER = $_SESSION["EMAILUSER"];
        $NOMEUSER = $_SESSION["NOMEUSER"];
        
        criar_tarefa($NOMEUSER, $EMAILUSER, $TitleTask, $DescTask, $DataTask, $HoraTask);
        
        header("location: ./");     

    }else{

        $msg = "Preencha os Campos.";

    }

    header("location: ./index.php");

}

//Verifica na URL se existe a variáve 's' (para o usuário sair da sessão de login)
if(isset($_REQUEST['session_destoy'])){

    session_destroy();

    header("location: ./index.php");

}

//Verifica na URL se existe a variáve 'dt' (para a remoção da tarefa)
if(isset($_REQUEST['dt'])){

    $DataTarefaDt = explode(" ", $_REQUEST["dt"]);

    $Data = $DataTarefaDt[0];
    $Hora = $DataTarefaDt[1];

    delete_tarefa($Data, $Hora, $_SESSION["EMAILUSER"]);
    
    header("location: ./index.php");

}

//
if(isset($_SESSION["EMAILUSER"]) && isset($_SESSION["NOMEUSER"])){

    $DataAtual = date("d-m-Y");
    $HoraAtual = date("H:i");
    $DataAtualEx = explode("-", $DataAtual);
    $HoraATualEx = explode(":", $HoraAtual);
    
    $result = select_tarefa($_SESSION["EMAILUSER"]);

    foreach($result as $r){

        $DataTarefa = $r["DATA"];
        $DataTarefaEx = explode("-", $DataTarefa);
        $HoraTarefa = $r["HORA"];
        $HoraTarefaEx = explode(":", $HoraTarefa);

        if($DataTarefaEx[2] < $DataAtualEx[2]){

            delete_tarefa($DataTarefa, $HoraTarefa, $_SESSION["EMAILUSER"]);

        }elseif($DataTarefaEx[2] == $DataAtualEx[2]){

            if($DataTarefaEx[1] < $DataAtualEx[1]){

                delete_tarefa($DataTarefa, $HoraTarefa, $_SESSION["EMAILUSER"]);

            }elseif($DataTarefaEx[1] == $DataAtualEx[1]){

                if($DataTarefaEx[0] < $DataAtualEx[0]){

                    delete_tarefa($DataTarefa, $HoraTarefa, $_SESSION["EMAILUSER"]);

                }elseif($DataAtualEx[0] == $DataTarefaEx[0]){

                    if($HoraTarefaEx[0] < $HoraATualEx[0]){

                        delete_tarefa($DataTarefa, $HoraTarefa, $_SESSION["EMAILUSER"]);

                    }elseif($HoraTarefaEx[0] == $HoraATualEx[0]){

                        if($HoraTarefaEx[1] < $HoraATualEx[1]){

                            delete_tarefa($DataTarefa, $HoraTarefa, $_SESSION["EMAILUSER"]);

                        }

                    }

                }

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

    <link rel="stylesheet" href="./ASSETS/CSS/styles.css">

</head>
<body>

    

    <header class="header">

        <a href="" class="header__ancor"><img src="./ASSETS/IMAGES/iconSite.png" alt="" class="header__icon"></a>

        <nav class="nav">

            <ul class="nav__list">

                <li class="nav__item"><a href="./index.php" class="nav__ancor">HOME</a></li>

                <?php
                
                if(!isset($_SESSION["EMAILUSER"])){

                    echo "
                    <li class='nav__item'><span class='nav__ancor' onclick='openFormCadastroLogin()'>ENTRAR</span></li>
                    <li class='nav__item'><span class='nav__ancor' onclick='openFormCadastroUser()'>CADASTRE-SE</span></li>";

                }else{
                    echo "
                    <li class='nav__item'><a href='?session_destoy' class='nav__ancor'>SAIR</a></li>";
                }
                
                ?>

            </ul>

            <ul class="nav__list--mobile">

                <input type="radio" name="nav__item" id="nav__input--home" hidden checked>

                <li class="nav__item nav__item--home"><label for="nav__input--home" class='nav__label'><a href="./index.php" class="nav__ancor"><i class="ph ph-house"></i></a></label></li>

                <?php
                
                if(!isset($_SESSION["EMAILUSER"])){

                    echo "
                    <input type=radio name='nav__item' id='nav__input--login' hidden>

                    <li class='nav__item nav__item--login'><label for='nav__input--login' class='nav__label' onclick='openFormCadastroLogin()'><i class='ph ph-sign-in'></i></label></li>

                    <input type=radio name='nav__item' id='nav__input--cadastro' hidden>

                    <li class='nav__item nav__item--cadastro'><label for='nav__input--cadastro' class='nav__label' onclick='openFormCadastroUser()'><i class='ph ph-user-plus'></i></label></li>";

                }else{
                    echo "
                    <input type=radio name='nav__item' id='nav__input--sair' hidden>

                    <li class='nav__item nav__item--sair'><label for='nav__input--sair' class='nav__label'><a href='?session_destoy' class='nav__ancor'><i class='ph ph-sign-out'></i></a></label></li>";
                }
                
                ?>

            </ul>

        </nav>

    </header>

    <main class="main">

        <article class="main__container">

            <section class="box--forms">

                <button class="box__button" onclick="closeAllForms()">X</button>

                <div class="box__container">

                    <form action="" method="post" class="box__form box__form--tarefa">

                        <fieldset class="box__fieldset">

                            <legend class="box__legend">Cadastro de Tarefas</legend>
                                    
                            <label for="TitleTask" class="box__label">Titulo da Tarefa</label>
                            <input type="text" name="TitleTask" id="TitleTask" class="box__input">
                                    
                            <label for="DescTask" class="box__label">Descrição da tarefa</label>
                            <input type="text" name="DescTask" id="DescTask" class="box__input">

                            <label for="HoraTask" class="box__label">Horário</label>
                            <input type="time" name="HoraTask" id="HoraTask" class="box__input">

                            <label for="DataTask" class="box__label">Data</label>
                            <input type="text" name="DataTask" id="DataTask" class="box__input box__input--date" readonly>

                            <input type="submit" value="Finalizar" class="box__input box__input--submit">

                        </fieldset>

                    </form>

                    <form action="" method="post" class="box__form box__form--login">

                        <fieldset class="box__fieldset">

                            <legend class="box__legend">LOGIN</legend>

                            <label for="EmailUser" class="box__label">Seu E-Mail</label>
                            <input type="text" name="EmailUser" id="EmailUser" class="box__input">
                            
                            <label for="PswUser" class="box__label">Sua Senha</label>
                            <input type="text" name="PswUser" id="PswUser" class="box__input">

                            <input type="submit" value="Entrar" class="box__input--submit">
                        
                        </fieldset>

                    </form>

                    <form action="" method="post" class="box__form box__form--cadastro">

                        <fieldset class="box__fieldset">

                            <legend class="box__legend"></legend>

                            <label for="NameUser" class="box__label">Nome</label>
                            <input type="text" name="NameUser" id="NameUser" class="box__input">
                            
                            <label for="EmailUser" class="box__label">E-Mail</label>
                            <input type="text" name="EmailUser" id="EmailUser" class="box__input">
                            
                            <label for="TelUser" class="box__label">Telefone</label>
                            <input type="text" name="TelUser" id="TelUser" class="box__input">
                            
                            <label for="SenhaUser" class="box__label">Senha</label>
                            <input type="text" name="SenhaUser" id="SenhaUser" class="box__input">

                            <input type="submit" value="Cadastar" class="box__input--submit">

                        </fieldset>

                    </form>

                    <div class="box--task">

                        <div class="box__container">

                            <?php
                            
                            //Verifica se existe a variável de sessão
                            if(isset($_SESSION["EMAILUSER"])){

                                $DATAa = ""; //<- Não utulizado (por enquanto)

                                $result = select_tarefa($_SESSION["EMAILUSER"]);

                                //Percorre o array que contém os dados das tarefas e mostra para o usuário
                                foreach($result as $r){

                                    $EMAIL_USER = $r['FK_EMAIL_USER'];
                                    $TITULO = $r['TITULO'];
                                    $DESCRICAO = $r['DESCRICAO'];
                                    $DATA = $r['DATA'];
                                    $HORARIO = $r["HORA"];

                                    echo "<div class='box__tarefa'> <div class='box__button--ex'><a href='?dt=$DATA $HORARIO' class='box__ancor'>X</a></div> <div class='box__content'> <div class='box__head'> <span class='box__data'>$DATA</span> <span class='box__hora'>$HORARIO</span> </div> <span class='box__title'>$TITULO</span> <span class='box__desc'>$DESCRICAO</span> </div> </div>";
                                }

                            }
                            
                            ?>

                        </div>

                    </div>

                </div>  

            </section>

            <section class="box--body">

                <div class="box__calendar box__calendar--1">

                    <?php
                    
                    for($c = 0; $c < 12; $c ++){
                        $DataMes = date("M", strtotime("+$c Month first day of January"));

                        echo "

                        <div class='box__contains' onclick='openMonth($c)'>

                            <h2 class='box__title'>$DataMes</h2>

                            <div class='box__mes box__mes--1'>

                                <span class='box__span'>D</span>
                                <span class='box__span'>S</span>
                                <span class='box__span'>T</span>
                                <span class='box__span'>Q</span>
                                <span class='box__span'>Q</span>
                                <span class='box__span'>S</span>
                                <span class='box__span'>S</span>
                            
                            ";

                        $DataDiaMesAno = date("d-m-Y", strtotime("+$c Month first day of January"));
                        
                        $DataDiaMesAnoExplode = explode("-", $DataDiaMesAno);
                        $DiasTotalMes = cal_days_in_month(CAL_GREGORIAN, $DataDiaMesAnoExplode[1], $DataDiaMesAnoExplode[2]);
                        
                        for($c2 = 1; $c2 <= $DiasTotalMes; $c2 ++){

                            //Verifica cada dia 1° para assim, adicionar elementos HTML para que os dias de semana do mes retejam corretos
                            if($c2 == 1){
                                $DataAnoMesDia = date("l", strtotime($DataDiaMesAnoExplode[2] . $DataDiaMesAnoExplode[1] . $DataDiaMesAnoExplode[0]));
                                $diasRestantes = verifica_dia($DataAnoMesDia);

                                for($diasRestantes; $diasRestantes > 0; $diasRestantes --){

                                    echo "<div class='box__day'>X</div>";

                                }

                            }

                            $DataAno = $DataDiaMesAnoExplode[2];

                            $cd = $c + 1;

                            echo "<div class='box__day $c2-$cd-$DataAno'>$c2</div>";
                        }

                        echo "</div></div>";
                    }
                    
                    ?>

                </div>

                <div class="box__calendar box__calendar--2">

                    <?php
                    
                    for($c = 0; $c < 12; $c ++){
                        $DataMes = date("M", strtotime("+$c Month first day of January"));
                        echo "

                        <div class='box__contains'>

                            <h2 class='box__title'>$DataMes</h2>

                            <div class='box__mes box__mes--2'>

                                <span class='box__span'>D</span>
                                <span class='box__span'>S</span>
                                <span class='box__span'>T</span>
                                <span class='box__span'>Q</span>
                                <span class='box__span'>Q</span>
                                <span class='box__span'>S</span>
                                <span class='box__span'>S</span>
                            
                            ";

                        $DataMesAno = date("d-m-Y", strtotime("+$c Month first day of January"));

                        $DataMesAnoExplode = explode("-", $DataMesAno);
                        $DiasTotalMes = cal_days_in_month(CAL_GREGORIAN, $DataMesAnoExplode[1], $DataMesAnoExplode[2]);
                        
                        for($c2 = 1; $c2 <= $DiasTotalMes; $c2 ++){
                        
                            //Verifica cada dia 1° para assim, adicionar elementos HTML para que os dias de semana do mes retejam corretos
                            if($c2 == 1){
                                $DataAnoMesDia = date("l", strtotime($DataMesAnoExplode[2] . $DataMesAnoExplode[1] . $DataMesAnoExplode[0]));
                                $diasRestantes = verifica_dia($DataAnoMesDia);

                                for($diasRestantes; $diasRestantes > 0; $diasRestantes --){

                                    echo "<div class='box__day'>X</div>";

                                }

                            }

                            $DataAno = $DataDiaMesAnoExplode[2];

                            $cd = $c + 1;

                            echo "<div class='box__day $c2-$cd-$DataAno' onclick='openFormTarefa($c2, $cd, $DataAno)'>$c2</div>";
                        }

                        echo "</div></div>";
                    }
                    
                    ?>

                </div>

            </section>

        </article>

    </main>

    <footer class="footer">

        <article class="footer__container">

            <div class="box box--contatos">

                <h2>Colaboradores:</h2>

                <ul class="box__list">

                    <li class="box__item">Hugo Otávio dos Santos de Paula</li>

                    <li class="box__item">Vinicius Ribeiro Renó</li>

                    <li class="box__item">Luis Guilherme Marcondes</li>

                    <li class="box__item">Renan Mariz de Sousa</li>

                    <li class="box__item">João Paulo</li>

                    <li class="box__item">William</li>

                </ul>

            </div>

        </article>

    </footer>

    <script src="./ASSETS/JS/scriptAll.js"></script>

    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
</body>
</html>