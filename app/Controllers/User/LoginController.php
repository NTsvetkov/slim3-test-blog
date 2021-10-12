<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Entity\User;

class LoginController extends Controller
{
    public function getLogin($request, $response)
    {
        return $this->view->render($response, 'users/login.twig');
    }

    public function postLogin($request, $response)
    {
        $username = $request->getParam('username');
        $password = $request->getParam('password');
        $user = $this->em->getRepository(User::class)->findOneBy([
            'username' => $username,
        ]);
        if (!$user || !password_verify($password, $user->getPassword())) {
            $this->flash->addMessage('error', 'Invalid user/password');

            return $response->withRedirect($this->router->pathFor('auth.login'));
        }
        $_SESSION['user'] = $user->getId();

        return $response->withRedirect($this->router->pathFor('home'));
    }

}