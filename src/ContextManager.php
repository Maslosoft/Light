<?php

namespace Maslosoft\Light;

use Maslosoft\Light\Contexts\Steady;
use Maslosoft\Light\Contexts\OpenSwoole;

class ContextManager
{
	public const int MaxContextLifetime = 10 * 60;

	public const float DefaultChanceOfPurge = 0.01;

	public const array DefaultContexts = [
		OpenSwoole::class,
		Steady::class,
	];

	/**
	 * Maximum context lifetime
	 */
	public static int $maxLifetime = self::MaxContextLifetime;

	/**
	 * Percent chance of running purge if using maybePurge();
	 */
	public static float $purgeChance = self::DefaultChanceOfPurge;

	/**
	 * Contexts to check availability in order of preference
	 */
	public static array $contexts = self::DefaultContexts;

	private static string|Context|null $selectedContext = null;

	/**
	 * Get beset available context class
	 */
	public static function get(): string|Context|null
	{
		static::init();
		return static::$selectedContext;
	}

	public static function purge(): void
	{
		static::init();
		$now = time();

		foreach (self::$selectedContext::list() as $key)
		{
			$data = self::$selectedContext::get($key);
			if (($now - $data[LastUsed]) > static::$maxLifetime)
			{
				// Remove stale resource
				self::$selectedContext::delete($key);
			}
		}
	}

	public function maybePurge(): void
	{
		// Purge by chance
		if (random_int(1, 100) <= self::$purgeChance * 100)
		{
			static::purge();
		}
	}

	private static function init(): void
	{
		// Check if initialized
		if (self::$selectedContext !== null)
		{
			return;
		}
		foreach (static::$contexts as $context)
		{
			if ($context::isAvailable())
			{
				static::$selectedContext = $context;
			}
		}
	}
}    
