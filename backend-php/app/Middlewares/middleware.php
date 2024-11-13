<?php

namespace App\Middlewares;

use App\Controllers\SessionController;

class middleware extends SessionController {

    // @method void VerifySession($id)
    // Esta função recebe um ID
    public function VerifySession($id): void {
        $this->OpenSession();
        if(isset($_SESSION['id'])){
            if($_SESSION['id'] == $id){
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        } else {
            echo json_encode(false);
        }
    }
}