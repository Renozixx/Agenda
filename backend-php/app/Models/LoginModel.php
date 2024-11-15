<?php

namespace App\Models;

use App\Controllers\LoginController;
use App\Middlewares\middleware;

class LoginModel extends LoginController {

    public function selectLogin(string $email, string $password)
    {
        $emailmid = $this->connection->quote($email);
        $senhamid = $this->connection->quote($password);
        $this->closeConnection();
        $senhareal = md5($senhamid);
        
        $result = $this->validandoLogin($emailmid, $senhamid);
        if($result){
            session_start();
            $_SESSION['id'] = $result[0][0];
            http_response_code(200);
            echo json_encode(array(true, 'id' => $result[0][0]));
        } else {
            http_response_code(205);
            echo json_encode(false);
        }
    }

}