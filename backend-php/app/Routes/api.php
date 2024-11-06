<?php

require_once __DIR__ . '/../../vendor/autoload.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

use App\Models\LoginModel;
use App\Models\Cadastro;
use App\Models\Tasks;
use App\Middlewares\middleware;

class Request {
    // Fala hugao, consegui concertar o sistma de rotas, e o mais importante as nossas requisições HTTP, amém kkkkkkk
    // Bem eu queria só dizer que agora o Axios funciona, o React Funciona e aqui nesse arquivo, que você vai 
    // Fazer com que o nosso PHP interaja com o Front-End.

    // Essa função pega a requisição que estamos fazendo do front-end e separa só o que a gente quer
    private function getURL ()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode("/", $url);
        return $url[4];
    }

    // Essa função pega a URL, e trata ela como uma rota como conhecemos, não está como o laravel, porem já está
    // Mais parecido com algo mais organizado, depois que a gente evoluir vale dar uma melhorada nisso.
    public function Route ()
    {
        $route = $this->getURL();
        $metodo = $_SERVER['REQUEST_METHOD'];

        // Vamos fazer um IF gigante para decidir entra cada rota, pode ser meio burro mas é oque temos.
        switch($route) {
            case 'verify':
                $middle = new middleware;
                if(isset($_POST['id'])){
                    $middle->VerifySession($_POST['id']);
                } else {
                    echo json_encode(['mesagem' => 'Erro com o metodo post']);
                }
                break;
            case 'login':
                $model = new LoginModel;
                if(isset($_POST['email']) && isset($_POST['password'])){
                    $model->selectLogin($_POST['email'], $_POST['password']);
                }
                else {
                    echo json_encode(array('mensagem' => 'Problemas com o metodo post'));
                }
                break;
            case "register":
                $cadastro = new Cadastro;
                $cadastro->create("users", ["username" => $_POST["nome"], "email" => $_POST["email"], "password" => $_POST["password"], "phone" => $_POST["telefone"]]);
                break;
            case "requestTasks":
                $tasks = new Tasks();
                http_response_code(200);
                echo json_encode($tasks->getTasks());
                break;
            case "createTask":
                $tasks = new Tasks();
                $title = $_POST["title"];
                $desc = $_POST["desc"];
                $date = $_POST["date"];
                $time = $_POST["time"];
                $tasks->create(chr(39)."$title".chr(39).", ".chr(39)."$desc".chr(39).", ".chr(39)."$date".chr(39).", ".chr(39)."$time".chr(39).", 1");
                http_response_code(200);
                echo json_encode([$_POST]);
                break;
        }
    }
}

$req = new Request();
$req->Route();
