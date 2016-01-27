<?php
namespace Autenticacao\Controllers;

use stdClass as stdClass;
use Respect\Rest\Routable as Routable;
use Respect\Relational\Mapper as Mapper;
use Autenticacao\Repositories\UsuarioRepository as UsuarioRepository;

class ListaController extends ListaController__AopProxied implements \Go\Aop\Proxy
{

    /**
     * Property was created automatically, do not change it manually
     */
    private static $__joinPoints = array();
    
    
    public function __construct(\Respect\Relational\Mapper $mapper)
    {
        return self::$__joinPoints['method:__construct']->__invoke($this, array($mapper));
    }
    
    
    public function get()
    {
        return self::$__joinPoints['method:get']->__invoke($this);
    }
    
}
\Go\Proxy\ClassProxy::injectJoinPoints('Autenticacao\Controllers\ListaController',array (
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
  ),
));