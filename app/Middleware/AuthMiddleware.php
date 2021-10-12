<?php

namespace App\Middleware;

class AuthMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        if (!$this->container->auth->loggedin()) {
            $this->container->flash->addMessage('error', 'You must be logged in!');

            return $response->withRedirect($this->container->router->pathFor('auth.login'));
        }
        $response = $next($request, $response);

        return $response;
    }
}