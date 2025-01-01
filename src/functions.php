<?php

namespace Maslosoft\Light;

use function Swoole\Coroutine\run as swooleRun;

function run($callback)
{
	if (function_exists('Swoole\Coroutine\run'))
	{
		swooleRun($callback);
	}
}