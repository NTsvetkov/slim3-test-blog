<?php

$container = $app->getContainer();

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

    return $view;
};

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

$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};
