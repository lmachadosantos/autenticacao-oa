<?php
define('BASE_URL', '/');
define('APPLICATION_PATH', dirname(realpath(__FILE__)) . '/../');
define('APPLICATION_ENVIRONMENT', 'desenvolvimento');

switch (APPLICATION_ENVIRONMENT) {
    case 'desenvolvimento':
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        break;
    case 'teste':
    case 'producao':
        error_reporting(0);
        break;
    default:
        exit('O ambiente do aplicativo não está definida corretamente .');
}

require_once (APPLICATION_PATH . '/vendor/autoload.php');

$container = \Autenticacao\Container::obtemInstancia();

$mapper = $container->mapper;
$mapper->entityNamespace = '\\Autenticacao\\Entities\\';

$router = $container->router;

$router->post(BASE_URL . "public/usuario", "\\Autenticacao\\Controllers\\UsuarioController", array(
    $container->mapper
))->accept(array(
    'application/json' => function ($obj) {
        echo json_encode($obj);
    }
));

$router->get(BASE_URL . "public/usuario/*", "\\Autenticacao\\Controllers\\UsuarioController", array(
    $container->mapper
))->accept(array(
    'application/json' => function ($obj) {
        echo json_encode($obj);
    }
));

$router->put(BASE_URL . "public/usuario/*", "\\Autenticacao\\Controllers\\UsuarioController", array(
    $container->mapper
))->accept(array(
    'application/json' => function ($obj) {
        echo json_encode($obj);
    }
));

echo $router->run();