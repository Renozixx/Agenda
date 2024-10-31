<?php

namespace App\Controllers;

use Database\Database;
class LoginController extends Database {
    public function ValidandoLogin(string $email, string $password) {
        $result = $this->select("*", "users", "WHERE email='$email' AND password='$password'");
        return $result;
    }
}