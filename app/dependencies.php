<?php

use Respect\Validation\Factory;

$container['em'] = function ($c) {
    $settings = $c->get('settings');
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        $settings['doctrine']['meta']['entity_path'],
        $settings['doctrine']['meta']['auto_generate_proxies'],
        $settings['doctrine']['meta']['proxy_dir'],
        $settings['doctrine']['meta']['cache'],
        false
    );

    return \Doctrine\ORM\EntityManager::create($settings['doctrine']['connection'], $config);
};
$container['auth'] = function ($container) {
    return new \App\Middleware\Auth($container);
};
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../resourses/views', [
        'debug' => true,
        'cache' => false,
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));
    $view->addExtension(new \Twig\Extension\DebugExtension());
    $view->getEnvironment()->addGlobal('auth', [
        'loggedin' => $container->auth->loggedin(),
        'user' => $container->auth->user(),
    ]);
    $view->getEnvironment()->addGlobal('flash', $container->flash);

    return $view;
};
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};
$container['validator'] = function ($container) {
    return new \App\Validation\Validator();
};
$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};
$container['LoginController'] = function ($container) {
    return new \App\Controllers\User\LoginController($container);
};
$container['LogoutController'] = function ($container) {
    return new \App\Controllers\User\LogoutController($container);
};
$container['RegisterController'] = function ($container) {
    return new \App\Controllers\User\RegisterController($container);
};
$container['PasswordController'] = function ($container) {
    return new \App\Controllers\User\PasswordController($container);
};
$container['EditProfileController'] = function ($container) {
    return new \App\Controllers\User\EditProfileController($container);
};
$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \App\Middleware\OldInputMiddleware($container));

Factory::setDefaultInstance(
    (new Factory())
        ->withRuleNamespace('App\\Validation\\Rules')
        ->withExceptionNamespace('App\\Validation\\Exceptions')
);

