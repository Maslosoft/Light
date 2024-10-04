<?php

namespace Maslosoft\Light\Context;

use Swoole\Coroutine\Context as SwooleContext;
use Maslosoft\Light\Contexts\Steady;

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
    if(class_exists(SwooleContext::class, true))
    {
      static::$contextClass = SwooleContext::class;
      return;
    }

    // Finally, as a fallback use just static variables
    static::$contextClass = Steady::class;
  }
}
