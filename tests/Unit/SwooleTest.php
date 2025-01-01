<?php


namespace Unit;

use Codeception\Test\Unit;
use Maslosoft\Light\ContextManager;
use Maslosoft\Light\Contexts\Swoole;
use Maslosoft\Light\Tests\Models\WithScalars;
use Tests\Support\UnitTester;
use function Maslosoft\Light\run;

class SwooleTest extends Unit
{

	protected UnitTester $tester;

	protected function _before(): void
	{
		ContextManager::$contexts = [
			Swoole::class,
		];
	}

	// tests
	public function testCreatingFlyweightInstance(): void
	{
		if(!extension_loaded('swoole'))
		{
			$this->markTestSkipped('Swoole extension not loaded');
		}
		run(function () {
			$instance = WithScalars::fly();
			$instance->title = 'test';

			$second = WithScalars::fly();

			$this->assertEquals($instance->title, 'test');
			$this->assertEquals($second->title, 'test');
		});
		run(function () {
			$instance = WithScalars::fly();

			$this->assertEquals($instance->title, '', 'Has initial value');

			$instance->title = 'test2';

			$second = WithScalars::fly();

			$this->assertEquals($instance->title, 'test2');
			$this->assertEquals($second->title, 'test2');
		});
	}
}
