<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use Respect\Validation\Validator as v;

class EditProfileController extends Controller
{
    public function getEditProfile($request, $response)
    {
        $old = $this->auth->user();
        $this->container->view->getEnvironment()->addGlobal('old', $old);

        return $this->view->render($response, 'users/edit.twig');
    }

    public function postEditProfile($request, $response)
    {
        $user = $this->auth->user();
        $validatorRule = v::noWhitespace()->notEmpty()->email();
        if ($request->getParam('email') != $user->getEmail()) {
            $validatorRule->emailAvailable($this->em);
        }
        $validation = $this->validator->validate($request, [
            'fullname' => v::notEmpty(),
            'email'    => $validatorRule
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('auth.profile.edit'));
        }

        $user->setFullName($request->getParam('fullname'));
        $user->setEmail($request->getParam('email'));
        $this->em->persist($user);
        $this->em->flush();
        $this->flash->addMessage('info', 'User edited successfully.');

        return $response->withRedirect($this->router->pathFor('home'));
    }
}
