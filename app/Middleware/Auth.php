<?php

namespace App\Middleware;

use App\Controllers\Controller;
use App\Entity\User;

class Auth extends Controller
{
    public function user()
    {
        return isset($_SESSION['user']) ? $this->em->getRepository(User::class)->find($_SESSION['user']) : null;
    }

    public function loggedin()
    {
        return isset($_SESSION['user']);
    }
}