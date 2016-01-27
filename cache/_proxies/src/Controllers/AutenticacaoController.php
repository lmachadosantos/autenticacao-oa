<?php
namespace Autenticacao\Controllers;

use Autenticacao\Entities\AcessoToken as AcessoToken;
use Autenticacao\Repositories\UsuarioRepository as UsuarioRepository;
use Respect\Relational\Mapper as Mapper;
use Respect\Rest\Routable as Routable;
use stdClass as stdClass;

class AutenticacaoController extends AutenticacaoController__AopProxied implements \Go\Aop\Proxy
{

    /**
     * Property was created automatically, do not change it manually
     */
    private static $__joinPoints = array();
    
    
    public function __construct(\Respect\Relational\Mapper $mapper)
    {
        return self::$__joinPoints['method:__construct']->__invoke($this, array($mapper));
    }
    
    
    public function post()
    {
        return self::$__joinPoints['method:post']->__invoke($this);
    }
    
}
\Go\Proxy\ClassProxy::injectJoinPoints('Autenticacao\Controllers\AutenticacaoController',array (
  'method' => 
  array (
    '__construct' => 
    array (
      0 => 'advisor.Autenticacao\\Aspect\\MonitorAspect->beforeMethodExecution',
    ),
    'post' => 
    array (
      0 => 'advisor.Autenticacao\\Aspect\\MonitorAspect->beforeMethodExecution',
    ),
  ),
));