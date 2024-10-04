<?php

namespace Maslosoft\Light;

use Maslosoft\Light\Contexts\Steady;
use Maslosoft\Light\Contexts\OpenSwoole;

class ContextManager
{
  /**
   * Contexts to check availabiliti in order of preference
   */
  public static $contexts = [
    OpenSwoole::class,
    Steady::class,
  ];

  private static $selectedContext = null;

  public static function purge()
  {
    static::init();
  }

  /**
   * Get beset available context class
   */
  public static function get()
  {
    static::init():
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
