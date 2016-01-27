<?php
namespace Autenticacao\Controllers;

use stdClass;
use Respect\Rest\Routable;
use Respect\Relational\Mapper;
use Autenticacao\Repositories\AcessoTokenRepository;

class AcessoTokenController implements Routable
{

    private $mapper;

    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function get($id = null)
    {
        $resposta = new stdClass();
        $resposta->success = false;
        
        $acessoTokenRepository = new AcessoTokenRepository($this->mapper);
        
        if ($id !== null) {
            $acessoToken = $acessoTokenRepository->obtem($id);
            
            if ($acessoToken) {
                $resposta->success = true;
                $resposta->acessoToken = $acessoToken->obtemCopia();
            }
        } else {
            $acessosToken = $acessoTokenRepository->obtemLista();
            $resposta->success = true;
            
            foreach ($acessosToken as $acessoToken) {
                $resposta->acessoToken[] = $acessoToken->obtemCopia();
            }
        }
        
        return $resposta;
    }

    public function delete($id)
    {
        parse_str(file_get_contents('php://input'), $_REQUEST);
        
        $id = (int) $id;
                
        $resposta = new stdClass();
        $resposta->success = false;
        
        $acessoTokenRepository = new AcessoTokenRepository($this->mapper);
        
        $acessoToken = $acessoTokenRepository->obtem($id);
        
        if ($acessoToken) {
            $acessoToken->delete();
            $acessoToken->defineAtualizadoEm(date('Y-m-d H:i:s'));
            
            $this->mapper->acessoToken->persist($acessoToken);
            $this->mapper->flush();
            
            $resposta->success = true;
        }
        return $resposta;
    }
}