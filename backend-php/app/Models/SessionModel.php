<?php

namespace App\Models;

use App\Controllers\SessionController;

class Session extends SessionController {
    public function logOut(): void{
        $this->EndSession();
    }
}