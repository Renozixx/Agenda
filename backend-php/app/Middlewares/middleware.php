<?php

namespace App\Middlewares;

use App\Controllers\SessionController;

/**
 * Classe middleware. Intercepta a requisição e trata-a
 * conforme necessário
 */
class middleware extends SessionController {
    protected function OpenSession() : void {
        if(!isset($_SESSION)) {
            session_start();
        }    
    }

    public function VerifySession($id): void {
        $this->OpenSession();
        if($_SESSION['id'] == $id){
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
}