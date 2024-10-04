<?php

namespace Maslosoft\Light\Contexts;

use Swoole\Coroutine\Context;

class OpenSwoole
{
  public static function has($key)
  {
    return Context::has($key);
  }

  public static function get($key)
  {
    return Context::get($key);
  }

  public static function put($key, $value)
  {
    return Context::put($key, $value);
  }
  
  public static function isAvailable()
  {
    return class_exists(Context::class, true);
  }
}
