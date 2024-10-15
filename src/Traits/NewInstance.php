<?php

namespace Maslosoft\Light\Traits;

trait NewInstance
{
	protected static function newInstance($instanceId): static
	{
		return new static($instanceId);
	}
}