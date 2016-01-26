<?php
namespace Autenticacao\Entities;

use Exception;
use stdClass;
use Respect\Validation\Validator;
use Respect\Validation\Exceptions\ValidationException;

class Usuario
{

    private $id;

    private $login;

    private $senha;

    private $criadoEm;

    private $atualizadoEm;

    private $excluido = 0;

    public function __construct()
    {
        $this->criadoEm = date("Y-m-d H:i:s");
    }

    public function obtemId()
    {
        return $this->id;
    }

    public function obtemLogin()
    {
        return $this->login;
    }

    public function defineLogin($login)
    {
        $loginValidador = Validator::stringType()->notEmpty()
            ->noWhitespace()
            ->length(8, 120);
        
        try {
            $loginValidador->check($login);
            $this->login = $login;
        } catch (ValidationException $exception) {
            print_r($exception->getMainMessage());
        }
    }

    public function defineSenha($senhaCriptografada)
    {
        if ($senhaCriptografada) {
            $this->senha = $senhaCriptografada;
        } else {
            throw new Exception("Obrigatorio criptografar a senha!");
        }
    }

    public function criptografaSenha($senha)
    {
        $senhaCriptografada = null;
        
        $senhaValidador = Validator::alnum()->notEmpty()
            ->noWhitespace()
            ->length(4, 20);
        
        try {
            $senhaValidador->check($senha);
            $senhaCriptografada = md5($senha);
        } catch (ValidationException $exception) {
            print_r($exception->getMainMessage());
        }
        
        return $senhaCriptografada;
    }

    public function defineAtualizadoEm($atualizadoEm)
    {
        $atualizadoEmValidador = Validator::date('Y-m-d H:i:s');
        
        try {
            $atualizadoEmValidador->check($atualizadoEm);
            $this->atualizadoEm = $atualizadoEm;
        } catch (ValidationException $exception) {
            print_r($exception->getMainMessage());
        }
    }

    public function obtemCopia()
    {
        $usuario = new stdClass();
        $usuario->id = $this->obtemId();
        $usuario->login = $this->obtemLogin();
        
        return $usuario;
    }
}