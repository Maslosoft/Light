<?php

namespace Maslosoft\Light;

class Context
{
	private static string|null|Context $contextClass = null;

	public static function has($key)
	{
		self::init();
		return self::$contextClass::has($key);
	}

	public static function get($key)
	{
		self::init();
		return self::$contextClass::get($key);
	}

	public static function put($key, $value)
	{
		self::init();
		return self::$contextClass::put($key, $value);
	}

	/**
	 * @param $key
	 * @return void
	 */
	public static function delete($key): void
	{
		self::init();
		self::$contextClass::delete($key);
	}

	/**
	 * @return array
	 */
	public static function list(): array
	{
		self::init();
		return self::$contextClass::list();
	}

	private static function init(): void
	{
		if (static::$contextClass !== null)
		{
			return;
		}
		static::$contextClass = ContextManager::get();
	}
}
