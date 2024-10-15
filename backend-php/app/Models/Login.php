<?php

namespace app\Models;

require_once "./autoloader.php";

use app\Controllers\LoginController;

class Login extends LoginController {

    public function selectLogin(string $email, string $password)
    {
        $this->openConnection();
        $emailmid = $this->mysqli->real_escape_string($email);
        $senhamid = $this->mysqli->real_escape_string($password);
        $this->closeConnection();
        $senhareal = md5($senhamid);
        
        $result = $this->validandoLogin($emailmid, $senhareal);
        if($result){
            echo "foi";
            return $result;
        } else {
            echo "Usuário não encontrado";
        }
    }

}