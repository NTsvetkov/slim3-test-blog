<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Entity\User;

class ManageUsersController extends Controller
{
    public function getListUsers($request, $response)
    {
        $users = $this->em->getRepository(User::class)->findAll();

        return $this->view->render($response, 'users/list.twig', [
            'users' => $users,
        ]);
    }

    public function postListUsers($request, $response)
    {
        $userId = $request->getParam('id');
        if ($this->auth->user()->getId() == $userId) {
            $this->flash->addMessage('error', "You can't delete yourself!");

            return $response->withRedirect($this->router->pathFor('auth.listusers'));
        }

        $user = $this->em->getRepository(User::class)->find($userId);
        if (!$user) {
            $this->flash->addMessage('error', "The user doesn't exists!");

            return $response->withRedirect($this->router->pathFor('auth.listusers'));
        }

        $this->em->remove($user);
        $this->em->flush();
        $this->flash->addMessage('info', "The user was deleted successfully!");

        return $response->withRedirect($this->router->pathFor('auth.listusers'));
    }
}