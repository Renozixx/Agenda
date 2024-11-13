<?php
namespace app\Controllers;

class SessionController {
    protected function OpenSession() : void {
        if(!isset($_SESSION)) {
            session_start();
        }    
    }
    
    protected function EndSession() : void {
        $this->OpenSession();
        session_unset();
        session_destroy();
    }
}