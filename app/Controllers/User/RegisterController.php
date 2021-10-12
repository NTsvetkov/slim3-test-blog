<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Entity\User;
use Respect\Validation\Validator as v;

class RegisterController extends Controller
{
    public function getRegister($request, $response)
    {
        return $this->view->render($response, 'user/register.twig');
    }

    public function postRegister($request, $response)
    {
        $validation = $this->validator->validate($request, [
            'fullname' => v::notEmpty(),
            'username' => v::noWhitespace()->notEmpty()->alnum()->usernameAvailable($this->em),
            'email'    => v::noWhitespace()->notEmpty()->email()->emailAvailable($this->em),
            'password' => v::notEmpty()
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('auth.register'));
        }

        $user = new User();
        $user->setFullName($request->getParam('fullname'));
        $user->setUsername($request->getParam('username'));
        $user->setEmail($request->getParam('email'));
        $user->setPassword(password_hash($request->getParam('password'), PASSWORD_DEFAULT));
        $this->em->persist($user);
        $this->em->flush();
        $this->flash->addMessage('info', 'User registered successfully.');

        return $response->withRedirect($this->router->pathFor('home'));
    }
}
