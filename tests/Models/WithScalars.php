<?php

namespace Maslosoft\Light\Tests\Models;


use Maslosoft\Light\Traits\Fly;
use Maslosoft\Light\Traits\NewInstance;

class WithScalars
{
	use Fly,
		NewInstance;

	public string $title = '';
}