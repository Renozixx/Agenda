<?php

namespace app\Controllers;

require_once "./autoloader.php";

use database\Database;
class LoginController extends Database {
    public function ValidandoLogin(string $email, string $password) {
        $result = $this->select("*", "users", "WHERE email='$email' AND senha='$password'");
        return $result;
    }
}