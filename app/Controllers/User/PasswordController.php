<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use Respect\Validation\Validator as v;

class PasswordController extends Controller
{
    public function getChangePassword($request, $response)
    {
        return $this->view->render($response, 'users/password.twig');
    }

    public function postChangePassword($request, $response)
    {
        $validation = $this->validator->validate($request, [
            'password'     => v::noWhitespace()->notEmpty()->matchesPassword($this->auth->user()),
            'new_password' => v::notEmpty()
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('auth.password.change'));
        }

        $this->auth->user()->setPassword(password_hash(
            $request->getParam('new_password'),
            PASSWORD_DEFAULT)
        );
        $this->em->flush();
        $this->flash->addMessage('info', 'The password was changed successfully.');

        return $response->withRedirect($this->router->pathFor('home'));
    }
}
