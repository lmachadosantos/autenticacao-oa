<?php
namespace Autenticacao\Controllers;

use stdClass;
use Respect\Rest\Routable;
use Respect\Relational\Mapper;
use Autenticacao\Repositories\UsuarioRepository;

class ListaController__AopProxied implements Routable
{

    private $mapper;

    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function get()
    {        
        $resposta = new stdClass();
        $resposta->success = false;
        
        $usuarioRepository = new UsuarioRepository($this->mapper);
        
        $usuarios = $usuarioRepository->obtemLista();
        $resposta->success = true;
        
        foreach ($usuarios as $usuario) {
            $resposta->usuario[] = $usuario->obtemCopia();
        }

        return $resposta;
    }

}include_once AOP_CACHE_DIR . '/_proxies/src/Controllers/ListaController.php';

