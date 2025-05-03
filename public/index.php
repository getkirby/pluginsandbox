<?php

$root = dirname(__DIR__);

require $root . '/kirby/bootstrap.php';

$plugin     = 'locator';
$pluginRoot = $root . '/plugins/' . $plugin;

$pluginTemplateRoot = $pluginRoot . '/site/templates';

$kirby = new Kirby([
	'options' => [
		'api' => [
			'csrf' => 'dev'
		],
		'debug' => true,
		'email' => [
			'transport' => [
				'type'     => 'smtp',
				'host'     => '127.0.0.1',
				'port'     => 2525,
				'security' => false,
				'username' => 'sandbox.test',
				'password' => null
			]
		],
		'panel' => [
			'dev' => true
		]
	],
	'roots' => [
		'index'    => __DIR__,

		'accounts'  => $root . '/accounts',
		'cache'     => $root . '/cache',
		'content'   => $pluginRoot . '/content',
		'sessions'  => $root . '/sessions',
		'site'      => $pluginRoot . '/site',
		'templates' => is_dir($pluginTemplateRoot) ? $pluginTemplateRoot : $root . '/templates',
	]
]);

echo $kirby->render();
