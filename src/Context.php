<?php

namespace Maslosoft\Light\Context;

use Swoole\Coroutine\Context as SwooleContext;
use Maslosoft\Light\Contexts\Steady;
use Maslosoft\Light\ContextManager;

class Context
{
  private static $contextClass = null;

  public static function has($key)
  {
    self::init():
    return self::$contextClass::has($key);
  }

  public static function get($key)
  {
    self::init():
    return self::$contextClass::has($key);
  }

  public static function put($key, $value)
  {
    self::init():
    return self::$contextClass::put($key, $value);
  }
  
  private function init()
  {
    if(static::$contextClass !== null)
    {
      return;
    }
    static::$contextClass = ContextManager::get();
  }
}
