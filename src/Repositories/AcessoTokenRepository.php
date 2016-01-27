<?php
namespace Autenticacao\Repositories;

use Respect\Relational\Mapper;

class AcessoTokenRepository
{

    private $mapper;

    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function obtem($id)
    {
        $acessoToken = $this->mapper->acessoToken(array(
            'id' => "{$id}",
            'excluido' => 0
        ))->fetch();
        
        return $acessoToken;
    }

    public function obtemPorTokenValido($token)
    {
        $acessoToken = $this->mapper->acessoToken(array(
            'tokenAcesso' => "{$token}",
            'excluido' => 0,
            'dataHoraFim >=' => date('Y-m-d H:i:s')
        ))->fetch();
        
        return $acessoToken;
    }
}