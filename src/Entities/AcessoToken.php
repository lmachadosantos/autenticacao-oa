<?php
namespace Autenticacao\Entities;

use Autenticacao\Entities\Usuario;
use Exception;
use stdClass;
use Respect\Validation\Validator;
use Respect\Validation\Exceptions\ValidationException;

class AcessoToken
{

    private $id;

    private $usuarioId;

    private $tokenAcesso;

    private $dataHoraInicio;

    private $dataHoraFim;

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

    public function obtemUsuario()
    {
        return $this->usuarioId;
    }

    public function defineUsuario(Usuario $usuario)
    {
        $this->usuarioId = $usuario->obtemId();
    }

    public function obtemTokenAcesso()
    {
        return $this->tokenAcesso;
    }

    public function defineTokenAcesso($tokenAcesso)
    {
        $this->tokenAcesso = $tokenAcesso;
    }

    public function obtemDataHoraInicio()
    {
        return $this->dataHoraInicio;
    }

    public function defineDataHoraInicio($dataHoraInicio)
    {
        $dataHoraInicioValidador = Validator::date('Y-m-d H:i:s');
        
        try {
            $dataHoraInicioValidador->check($dataHoraInicio);
            $this->dataHoraInicio = $dataHoraInicio;
        } catch (ValidationException $exception) {
            print_r($exception->getMainMessage());
        }
    }

    public function obtemDataHoraFim()
    {
        return $this->dataHoraFim;
    }

    public function defineDataHoraFim($dataHoraFim)
    {
        $dataHoraFimValidador = Validator::date('Y-m-d H:i:s');
        
        try {
            $dataHoraFimValidador->check($dataHoraFim);
            $this->dataHoraFim = $dataHoraFim;
        } catch (ValidationException $exception) {
            print_r($exception->getMainMessage());
        }
    }

    public function geraTokenAcesso()
    {
        $tokenAcesso = null;
        $chave = "CHAVE";
        
        if (! $this->dataHoraInicio && ! $this->dataHoraFim)
            throw new Exception('Data e Hora do Inicio e do Fim, deve ser definida antes da geracao do token.');
        
        $tokenAcesso = md5($this->dataHoraInicio . $chave . $this->dataHoraFim);
        
        return $tokenAcesso;
    }

    public function calculaDataHoraFim()
    {
        $dataHoraFim = null;
        
        if (! $this->dataHoraInicio)
            throw new Exception('Data e Hora do Inicio, deve ser definida antes da geracao da Data e Hora do Fim');
        
        $dataHoraFim = date('Y-m-d H:i:s', strtotime('+30 minute', strtotime($this->dataHoraInicio)));
        
        return $dataHoraFim;
    }

    public function validaFormatoDoToken($tokenAcesso)
    {
        $validaToken = strpos($tokenAcesso, 'bearer');
        
        if ($validaToken === false)
            throw new Exception('O token está em um formato invalido!');
        
        return true;
    }
    
    public function delete()
    {
        $this->excluido = 1;
    }

    public function obtemCopia()
    {
        $acessoToken = new stdClass();
        $acessoToken->id = $this->obtemId();
        $acessoToken->usuarioId = $this->obtemUsuario();
        $acessoToken->tokenAcesso = $this->obtemTokenAcesso();
        $acessoToken->dataHoraInicio = $this->obtemDataHoraInicio();
        $acessoToken->dataHoraFim = $this->obtemDataHoraFim();
        
        return $acessoToken;
    }
}