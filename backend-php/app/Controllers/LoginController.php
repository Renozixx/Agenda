<?php

namespace app\Controllers;

require_once "./autoloader.php";

use database\Database;
class LoginController extends Database {
    public function ValidandoLogin(string $email, string $password) {
        $result = $this->select("*", "users", "WHERE EMAIL='$email' AND SENHA='$password'");
        return $result;
    }
}