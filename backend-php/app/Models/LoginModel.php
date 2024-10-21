<?php

namespace app\Models;

require_once "./autoloader.php";

use app\Controllers\LoginController;

class LoginModel extends LoginController {

    public function selectLogin(string $email, string $password)
    {
        $this->openConnection();
        $emailmid = $this->mysqli->real_escape_string($email);
        $senhamid = $this->mysqli->real_escape_string($password);
        $this->closeConnection();
        $senhareal = md5($senhamid);
        
        $result = $this->validandoLogin($emailmid, $senhamid);
        if($result){
            $result1 = array(
                "id" => $result[0][0], 
                "username" => $result[0][1],
                "email" => $result[0][2],
                "telefone" => $result[0][3]
            );
            return $result1;
        } else {
            return false;
        }
    }

}