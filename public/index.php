<?php

use Kirby\Cms\App;
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
			'dev'  => true,
			'menu' => function (App $kirby) {
				$core = ['site', 'languages', 'plugins', 'users', 'system'];

				return [
					'site',
					'languages',
					'-',
					'plugins',
					// all areas registered by the loaded plugin
					...array_diff($kirby->panel()->areas()->keys(), $core),
					'-',
					'users',
					'system'
				];
			}
		]
	],
	'roots' => [
		'index'    => __DIR__,

		'accounts'  => is_dir($pluginAccountsRoot) ? $pluginAccountsRoot : $root . '/accounts',
		'cache'     => $root . '/cache/' . $plugin,
		'content'   => $pluginRoot . '/content',
		// shared by all plugin setups, as they run on the same domain
		'license'   => $root . '/.license',
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

// self-sign a free local dev license if there is no valid one yet
if (
	$kirby->environment()->cli() === false &&
	$kirby->system()->isLocal() === true &&
	$kirby->system()->license()->isMissing() === true
) {
	$kirby->system()->register('FREE');
}

echo $kirby->render();
