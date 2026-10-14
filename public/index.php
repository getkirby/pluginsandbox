<?php

use Kirby\Filesystem\Dir;
use Kirby\Http\Response;

$root = dirname(__DIR__);

// `e()` needs to be disabled for the Blade plugin
define('KIRBY_HELPER_E', false);

require $root . '/kirby/bootstrap.php';
require $root . '/dialogs/PluginsDialogController.php';

session_start();

$plugin     = getenv('KIRBY_PLUGIN') ?: ($_SESSION['plugin'] ?? 'git-content');
$pluginRoot = $root . '/plugins/' . $plugin;

$pluginAccountsRoot = $pluginRoot . '/site/accounts';
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

		'accounts'  => is_dir($pluginAccountsRoot) ? $pluginAccountsRoot : $root . '/accounts',
		'cache'     => $root . '/cache/' . $plugin,
		'content'   => $pluginRoot . '/content',
		'sessions'  => $root . '/sessions',
		'site'      => $pluginRoot . '/site',
		'templates' => is_dir($pluginTemplateRoot) ? $pluginTemplateRoot : $root . '/templates',
	],
	'routes' => [
		[
			'pattern' => 'plugin/(:any)',
			'action'  => function (string $plugin) {
				$_SESSION['plugin'] = $plugin;

				// A non-JSON response enforces a real reload
				if (kirby()->panel()->isStateRequest() === true) {
					return new Response('', 'text/html');
				}

				go(kirby()->panel()->url('site'));
			}
		]
	],
	'areas' => [
		'plugins' => [
			'label'   => 'Plugins',
			'icon'    => 'lab',
			'menu'    => true,
			'dialog'  => 'plugins',
			'dialogs' => [
				'plugins' => fn() => new PluginsDialogController(
					plugins: Dir::dirs($root . '/plugins'),
					current: $plugin
				)
			]
		]
	],
	'commands' => [
		'sandbox:create:plugin' => require $root . '/commands/create/plugin.php'
	]
]);

echo $kirby->render();
