<?php

namespace Maslosoft\Light\Contexts;

class Steady
{
	private static array $registry = [];

	public static function has($key)
	{
		return array_key_exists($key, self::$registry);
	}

	public static function get($key)
	{
		return self::$registry[$key];
	}

	public static function put($key, $value): void
	{
		self::$registry[$key] = $value;
	}

	public static function list(): array
	{
		return self::$registry;
	}

	public static function delete($key): void
	{
		unset(self::$registry[$key]);
	}

	public static function isAvailable(): bool
	{
		return true;
	}
}    
