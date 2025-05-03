<?php

$root = dirname(__DIR__);

require $root . '/kirby/bootstrap.php';

session_start();

if ($changed = ($_GET['plugin'] ?? null)) {
	$_SESSION['plugin'] = $changed;
}

$plugin     = $_SESSION['plugin'] ?? 'git-content';
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
			'dev' => true, 
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
