<?php

namespace App\Controllers;

use Database\Database;
class LoginController extends Database {
    public function ValidandoLogin(string $email, string $password) {
        $result = $this->select("*", "users", "WHERE EMAIL='$email' AND SENHA='$password'");
        return $result;
    }
}