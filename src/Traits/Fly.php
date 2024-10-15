<?php

namespace Maslosoft\Light\Traits;

use Maslosoft\Light\Context;
use const Maslosoft\Light\CreatedAt;
use const Maslosoft\Light\Instance;
use const Maslosoft\Light\LastUsed;

trait Fly
{

	public const string|int|float DefaultInstanceId = 'default';

	/**
	 * @param string|int|float|null $instanceId
	 * @return static
	 */
	public static function fly(string|int|float|null $instanceId = null): static
	{
		if ($instanceId === null)
		{
			$instanceId = static::DefaultInstanceId;
		}
		// Generate a unique context key based on class and instance ID
		$key = static::class . '.' . $instanceId;
		$now = time();

		// Check if the instance already exists in the current context
		if (Context::has($key))
		{
			$data = Context::get($key);
			$data[LastUsed] = $now;
			Context::put($key, $data);
			return $data[Instance];
		}

		// Create a new instance using the abstract newInstance method
		$instance = static::newInstance($instanceId);

		Context::put($key, [
			Instance => $instance,
			CreatedAt => $now,
			LastUsed => $now
		]);

		return $instance;
	}

	// This method should be implemented by the class using the trait
	abstract protected static function newInstance($instanceId);
}
