<?php
echo 'PHP: ' . PHP_VERSION . PHP_EOL;
if(extension_loaded('openswoole'))
{
	echo 'OpenSwoole: ' . phpversion('openswoole') . PHP_EOL;
}
if(extension_loaded('swoole'))
{
	echo 'Swoole: ' . phpversion('swoole') . PHP_EOL;
}