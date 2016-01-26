<?php
namespace Autenticacao\Repositories;

use Respect\Relational\Mapper;

class UsuarioRepository
{

    private $mapper;

    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function obtem($id)
    {
        $usuario = $this->mapper->usuario(array(
            'id' => "{$id}",
            'excluido' => 0
        ))->fetch();
        
        return $usuario;
    }

    public function obtemLista()
    {
        $usuarios = $this->mapper->usuario(array(
            'excluido' => 0
        ))->fetchAll();
        
        return $usuarios;
    }

    public function loginExiste($login)
    {
        $usuario = $this->mapper->usuario(array(
            'login' => $login,
            'excluido' => 0
        ))->fetch();
        
        if ($usuario)
            return true;
        else
            return false;
    }
}