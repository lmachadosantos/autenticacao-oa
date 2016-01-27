<?php
namespace Autenticacao\Aspect;

use stdClass;
use Autenticacao\Entities\AcessoToken;
use Autenticacao\Repositories\AcessoTokenRepository;
use Autenticacao\Container;
use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;

class MonitorAspect implements Aspect
{
    
    /**
     * @Before("execution(public Autenticacao\Controllers\ListaUsuarioController->*(*))")
     * 
     * @param MethodInvocation $invocation            
     */
    public function beforeMethodExecution(MethodInvocation $invocation)
    {
        $container = Container::obtemInstancia();
        $mapper = $container->mapper;
        
        $headers = apache_request_headers();
        $token = null;
        $bearer = null;
        
        $resposta = new stdClass();
        $resposta->success = false;
        
        if (!isset($headers['Authorization']))
           die(json_encode($resposta));
            
        $authorization = (string) $headers['Authorization'];
        $acessoToken = new AcessoToken($mapper);
        
        if ($acessoToken->validaFormatoDoToken($authorization))
            list ($bearer, $token) = explode(" ", $authorization);
        
        $acessoTokenRepository = new AcessoTokenRepository($mapper);
        
        $sessaoValida = $acessoTokenRepository->obtemPorTokenValido($token);
        
        if (!$sessaoValida)
            die(json_encode($resposta));
    }
}