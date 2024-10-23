<?php

namespace resources\views;

require_once "./autoloader.php";

use app\Models\LoginModel;

class LoginView extends LoginModel {
    
    public function ReturnLogin(string $email, string $pass){
        $model = new LoginModel;
        $result = $model->selectLogin($email, $pass);
        if($result == false){
            http_response_code(205);
            return $result;
        } else {
            http_response_code(200);
            return $result;
        }
    }
}