<?php

namespace src;
require "./autoloader.php";

class Request {
    public function getURL ()
    {
        return $_GET["route"];
    }

   public function Route ()
    {
        $route = $this->getURL();
        
        // Header -> Eles servem para tratar as informações do HTTP enviadas pelo cliente.
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: http://localhost:5173");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Access-Control-Allow-Credentials: true");

        if($route == 'login'){
            http_response_code(200);
            echo json_encode(["message" => "Login acessado", "rota" => $route]);
        }
    }
}

$request = new Request;
$request->Route();