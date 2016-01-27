<?php
namespace Autenticacao\Controllers;

use stdClass as stdClass;
use Respect\Rest\Routable as Routable;
use Respect\Relational\Mapper as Mapper;
use Autenticacao\Entities\Usuario as Usuario;
use Autenticacao\Repositories\UsuarioRepository as UsuarioRepository;

class UsuarioController extends UsuarioController__AopProxied implements \Go\Aop\Proxy
{

    /**
     * Property was created automatically, do not change it manually
     */
    private static $__joinPoints = array();
    
    
    public function __construct(\Respect\Relational\Mapper $mapper)
    {
        return self::$__joinPoints['method:__construct']->__invoke($this, array($mapper));
    }
    
    
    public function get($id = null)
    {
        return self::$__joinPoints['method:get']->__invoke($this, array($id));
    }
    
    
    public function post()
    {
        return self::$__joinPoints['method:post']->__invoke($this);
    }
    
    
    public function put($id)
    {
        return self::$__joinPoints['method:put']->__invoke($this, array($id));
    }
    
}
\Go\Proxy\ClassProxy::injectJoinPoints('Autenticacao\Controllers\UsuarioController',array (
  'method' => 
  array (
    '__construct' => 
    array (
      0 => 'advisor.Autenticacao\\Aspect\\MonitorAspect->beforeMethodExecution',
    ),
    'get' => 
    array (
      0 => 'advisor.Autenticacao\\Aspect\\MonitorAspect->beforeMethodExecution',
    ),
    'post' => 
    array (
      0 => 'advisor.Autenticacao\\Aspect\\MonitorAspect->beforeMethodExecution',
    ),
    'put' => 
    array (
      0 => 'advisor.Autenticacao\\Aspect\\MonitorAspect->beforeMethodExecution',
    ),
  ),
));