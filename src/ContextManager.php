<?php

namespace Maslosoft\Light;

use Maslosoft\Light\Contexts\Steady;
use Maslosoft\Light\Contexts\OpenSwoole;

class ContextManager
{
  public const MaxContextLifetime = 10 *60;
  
  /**
   * Maximum context lifetime
   */
  public static $maxLifetime = self::MaxContextLifetime;
  
  /**
   * Contexts to check availabiliti in order of preference
   */
  public static $contexts = [
    OpenSwoole::class,
    Steady::class,
  ];

  private static $selectedContext = null;

  /**
   * Get beset available context class
   */
  public static function get()
  {
    static::init():
    return static::$selectedContext;
  }

  public static function purge()
  {
    static::init();
    $now = time();

    foreach (self::$selectedContext::list() as $key) {
        $data = self::$selectedContext::get($key);
        if (($now - $data['last_used']) > static::$maxLifetime) {
            // Remove stale resource
            self::$selectedContex::delete($key);
        }
    }
  }

  private static function init()
  {
    // Check if initialized
    if(self::$selectedContext !== null)
    {
      return;
    }
    foreach(static::$contexts as $context)
    {
      if($context::isAvailable())
      {
        static::$selectedContext = $context;
      }
    }
  }
}    
