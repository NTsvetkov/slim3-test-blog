<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

$app->get('/', 'HomeController:index')->setName('home');

$app->group('', function () {
    $this->get('/login', 'LoginController:getLogin')->setName('auth.login');
    $this->post('/login', 'LoginController:postLogin');
    $this->get('/register', 'RegisterController:getRegister')->setName('auth.register');
    $this->post('/register', 'RegisterController:postRegister');
})->add(new GuestMiddleware($container));

$app->group('', function () {
    $this->get('/password', 'PasswordController:getChangePassword')->setName('auth.password.change');
    $this->post('/password', 'PasswordController:postChangePassword');
    $this->get('/profile', 'EditProfileController:getEditProfile')->setName('auth.profile.edit');
    $this->post('/profile', 'EditProfileController:postEditProfile');
    $this->get('/logout', 'LogoutController:getLogout')->setName('auth.logout');
})->add(new AuthMiddleware($container));

