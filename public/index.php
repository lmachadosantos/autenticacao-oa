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

require_once (APPLICATION_PATH . 'vendor/autoload.php');

$container = \Autenticacao\Container::obtemInstancia();

$applicationAspectKernel = \Autenticacao\ApplicationAspectKernel::getInstance();
$applicationAspectKernel->init(array(
    'debug' => true,
    'cacheDir' => APPLICATION_PATH . 'cache/'
));

$mapper = $container->mapper;
$mapper->entityNamespace = '\\Autenticacao\\Entities\\';

$router = $container->router;

// MODULO DE USUARIO
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

// MODULO DO ACESSO TOKEN
$router->get(BASE_URL . "public/acessoToken/*", "\\Autenticacao\\Controllers\\AcessoTokenController", array(
    $container->mapper
))->accept(array(
    'application/json' => function ($obj) {
        echo json_encode($obj);
    }
));

$router->delete(BASE_URL . "public/acessoToken/*", "\\Autenticacao\\Controllers\\AcessoTokenController", array(
    $container->mapper
))->accept(array(
    'application/json' => function ($obj) {
        echo json_encode($obj);
    }
));

// MODULO DE AUTENTICACAO
$router->post(BASE_URL . "public/autenticacao", "\\Autenticacao\\Controllers\\AutenticacaoController", array(
    $container->mapper
))->accept(array(
    'application/json' => function ($obj) {
        echo json_encode($obj);
    }
));

// MODULO DE LISTA RESTRITA
$router->get(BASE_URL . "public/listaUsuario", "\\Autenticacao\\Controllers\\ListaUsuarioController", array(
    $container->mapper
))->accept(array(
    'application/json' => function ($obj) {
        echo json_encode($obj);
    }
));

echo $router->run();