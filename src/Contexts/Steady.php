<?php

namespace Malosoft\Contexts;

class Steady
{
  private static $registry = [];
  
  public static function has($key)
  {
    return array_key_exists($registry);
  }

  public static function get($key)
  {
    return self::$registry[$key];
  }

  public static function put($key, $value)
  {
    self::registry[$key] = $value;
  }

  public static function list()
  {
    return self::registry;
  }

  public static function delete($key)
  {
    unset(self::registry[$key]);
  }
  
  public static function isAvailable()
  {
    return true;
  }
}    
