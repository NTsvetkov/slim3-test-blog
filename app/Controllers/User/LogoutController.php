<?php

namespace App\Controllers\User;

use App\Controllers\Controller;

class LogoutController extends Controller
{
    public function getLogout($request, $response)
    {
        unset($_SESSION['user']);

        return $response->withRedirect($this->router->pathFor('home'));
    }
}