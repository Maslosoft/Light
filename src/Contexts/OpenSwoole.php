<?php

namespace Maslosoft\Light\Contexts;

use OpenSwoole\Coroutine\Context;

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

  public static function list()
  {
    return Context::list();
  }

  public static function delete($key)
  {
    return Context::delete($key);
  }
  
  public static function isAvailable(): bool
  {
    return class_exists(Context::class, true);
  }
}
