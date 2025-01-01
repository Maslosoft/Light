<?php


namespace Tests\Unit;

use Codeception\Test\Unit;
use Maslosoft\Light\ContextManager;
use Maslosoft\Light\Contexts\Steady;
use Maslosoft\Light\Tests\Models\WithScalars;
use Tests\Support\UnitTester;

class StaticTest extends Unit
{

    protected UnitTester $tester;

    protected function _before(): void
	{
		return;
		ContextManager::$contexts = [
			Steady::class,
		];
    }

    // tests
    public function testCreatingFlyweightInstance(): void
	{
		return;
		$instance = WithScalars::fly();
		$instance->title = 'test';

		$second = WithScalars::fly();

		$this->assertEquals($instance->title, $second->title);
    }
}
