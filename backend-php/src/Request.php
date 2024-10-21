<?php

namespace src;
require "./autoloader.php";
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

use resources\views\LoginView;

class Request {
    // Fala hugao, consegui concertar o sistma de rotas, e o mais importante as nossas requisições HTTP, amém kkkkkkk
    // Bem eu queria só dizer que agora o Axios funciona, o React Funciona e aqui nesse arquivo, que você vai 
    // Fazer com que o nosso PHP interaja com o Front-End.

    // Essa função pega a requisição que estamos fazendo do front-end e separa só o que a gente quer
    private function getURL ()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode("/", $url);
        return $url[3];
    }

    // Essa função pega a URL, e trata ela como uma rota como conhecemos, não está como o laravel, porem já está
    // Mais parecido com algo mais organizado, depois que a gente evoluir vale dar uma melhorada nisso.
    public function Route ()
    {
        $route = $this->getURL();

        $metodo = $_SERVER['REQUEST_METHOD'];

        // Vamos fazer um IF gigante para decidir entra cada rota, pode ser meio burro mas é oque temos.
        if($route == 'home')
        {
            http_response_code(200);
            echo json_encode(array('message' => 'Esta acessando a HomePage'));
        }
    }
}

$req = new Request();
$req->Route();