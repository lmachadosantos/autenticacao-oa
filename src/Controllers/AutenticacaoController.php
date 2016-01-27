<?php
namespace Autenticacao\Controllers;

use Autenticacao\Entities\AcessoToken;
use Autenticacao\Repositories\UsuarioRepository;
use Respect\Relational\Mapper;
use Respect\Rest\Routable;
use stdClass;

class AutenticacaoController implements Routable
{

    private $mapper;

    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function post()
    {
        parse_str(file_get_contents('php://input'), $_REQUEST);
        
        $login = (! empty($_REQUEST['login'])) ? $_REQUEST['login'] : null;
        $senha = (! empty($_REQUEST['senha'])) ? $_REQUEST['senha'] : null;
        
        $resposta = new stdClass();
        $resposta->success = false;
        
        $usuarioRepository = new UsuarioRepository($this->mapper);
        $usuario = $usuarioRepository->obtemPorLogin($login);
        
        $autentica = $usuario->autentica($senha);
        
        if ($autentica) {
            $acessoToken = new AcessoToken();
            
            $acessoToken->defineUsuario($usuario);
            $acessoToken->defineDataHoraInicio(date("Y-m-d H:i:s"));
            $acessoToken->defineDataHoraFim($acessoToken->calculaDataHoraFim());
            $acessoToken->defineTokenAcesso($acessoToken->geraTokenAcesso());
            
            $this->mapper->acessoToken->persist($acessoToken);
            $this->mapper->flush();
            
            $resposta->success = true;
            $resposta->acessoToken = $acessoToken->obtemCopia();
        }
        
        return $resposta;
    }
}