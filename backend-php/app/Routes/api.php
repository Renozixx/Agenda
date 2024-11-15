<?php

use App\Models\Session;

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
use App\Controllers\DatesController;
use App\Controllers\EnvController;
use App\Controllers\HomePageController;
use App\Controllers\MonthController;
use App\Models\SessionModel;

/**
 * Classe para receber e tratar a requisições dos nossos micro serviços.
 */
class Api {

    /**
     * Recupera a requisição feita pela nossa API
     * e separa um parâmetro especifico
     * @var array $url
     * @return string
     */
    private function getURL (): string
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode("/", $url);

        return $url[4];
    }

    /**
     * Trata o parâmetro separado da URL,
     * retornado de 'getURL()'
     * @var string $route
     * @return void
     */
    public function Route (): void
    {
        $route = $this->getURL();
        $metodo = $_SERVER['REQUEST_METHOD'];

        switch($route) {
            // Caso que faz a verificação da sessão do usuario, com base em dois IDs, um enviado pelo front, e um armazenado no
            // Back, o que gera uma confiança maior em relação a segurança; Pretendo mudar para um codigo de segurança aleatorio
            // Gerado no processo de login, o que simularia um JWToken, porem nao seria ele exatamente
            case 'verify':
                $middle = new middleware;
                if(isset($_POST['id'])){
                    $middle->VerifySession($_POST['id']);
                } else {
                    echo json_encode(['mesagem' => 'Erro com o metodo post']);
                }
                break;
            case 'logout':
                $model = new SessionModel;
                $model->logOut();
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
            case "requestPersonal":
                $tasks = new Tasks();
                $datesController = new DatesController();
                $home = new HomePageController($datesController);
                $month = new MonthController($datesController);
                http_response_code(200);
                echo json_encode([$tasks->getTasks(), $home->genElements(), $month->genElement()]);
                break;
            case "requestTasks":
                $tasks = new Tasks();
                http_response_code(200);
                echo json_encode($tasks->getTasks());
                break;
            case "requestMonths":
                http_response_code(200);
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

$req = new Api();
$req->Route();
