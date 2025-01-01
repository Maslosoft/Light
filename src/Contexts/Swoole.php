<?php

namespace Maslosoft\Light\Contexts;

use Swoole\Coroutine;

class Swoole
{
	public static function has($key)
	{
		$context = Coroutine::getContext();
		if ($context === null)
		{
			return false;
		}
		return isset($context[$key]);
	}

	public static function get($key)
	{
		$context = Coroutine::getContext();
		return $context[$key] ?? null;
	}

	public static function put($key, $value)
	{
		$context = Coroutine::getContext();
		$context[$key] = $value;
		return true;
	}

	public static function list()
	{
		return Context::getContext();
	}

	public static function delete($key)
	{
		$context = Coroutine::getContext();
		unset($context[$key]);
		return true;
	}

	public static function isAvailable(): bool
	{
		return class_exists(Coroutine::class, true);
	}
}
