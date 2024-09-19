<?php

//Função para se conectar com o banco de dados
function conectar_banco()
{
    
    $host = "localhost";
    $user = "porti668_Admin";
    $password = "admin@@dmin#2oo5";
    $database = "porti668_projetosenacuc16";

    $link = mysqli_connect($host , $user , $password , $database);

    return $link;

}

//Função para adicionar dados de cadastro do usuário ao banco de dados
function adicionar_usuario($NOME , $EMAIL , $TELEFONE , $SENHA)
{
    $link = conectar_banco();

    $sql = "Insert into users (NOME , EMAIL , TELEFONE , SENHA) values ('$NOME' , '$EMAIL' , '$TELEFONE' , '$SENHA')";
    $result = mysqli_query($link , $sql);

    return $result;
}

//Função para verificar se um usuário existe no banco de dados
function verificar_usuario($EMAIL , $SENHA)
{

    $link = conectar_banco();

    $sql = "Select * from users where EMAIL = '$EMAIL' AND SENHA = '$SENHA'";
    $result = mysqli_query($link , $sql);

    return $result;

}

//Função para adicionar dados do cadastro da tarefa no banco de dados
function criar_tarefa ($FK_ID_USER , $FK_EMAIL_USER , $TITULO , $DESCRICAO , $DATA , $HORARIO)
{
    $link = conectar_banco();
    
    $sql = "Insert into tarefas (FK_ID_USER, FK_EMAIL_USER, TITULO, DESCRICAO, DATA ,HORA) values ('$FK_ID_USER' , '$FK_EMAIL_USER' , '$TITULO' , '$DESCRICAO' , '$DATA' , '$HORARIO')";

    $result = mysqli_query($link , $sql);

    return $result;

    if(!$result){
        echo mysqli_error($link);
    }
}

//Função para selecionar apenas as terafas correspoendentes ao usuário
function select_tarefa ($EMAIL)
{
    $link = conectar_banco();

    $sql = "SELECT * FROM tarefas WHERE FK_EMAIL_USER = '$EMAIL'";

    $result = mysqli_query($link , $sql);

    return $result;
}

//
function delete_tarefa ($DATA, $HORARIO , $EMAIL)
{
    $link = conectar_banco();

    $sql = "DELETE FROM tarefas WHERE HORA = '$HORARIO' AND DATA = '$DATA' AND FK_EMAIL_USER = '$EMAIL'";

    $result = mysqli_query($link , $sql);

    return $result;
}

//Função que cria um array com os dias da semana
function verifica_dia($diaSemana){

    $semana = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    $diasRestantes = array_search($diaSemana, $semana);
    return $diasRestantes;
}

?>