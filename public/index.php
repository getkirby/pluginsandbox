<?php

$root = dirname(__DIR__);

require $root . '/kirby/bootstrap.php';

session_start();

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
	], 
	'routes' => [
		[
			'pattern' => 'plugin/(:any)',
			'action' => function ($plugin) {
				$_SESSION['plugin'] = $plugin;
				return go('/panel/site/');
			}
		]
	],
	'areas' => [
		'plugins' => [
			'label' => 'Plugins',
			'icon' => 'lab',
			'menu' => [
				'dialog' => 'plugins'
			],
			'dialogs' => [
				[
					'pattern' => 'plugins', 
					'load'    => function () use ($plugin, $root)	{

						$plugins = Dir::dirs($root . '/plugins');

						return [
							'component' => 'k-form-dialog',
							'props' => [
								'fields' => [
									'plugin' => [
										'type'     => 'select',
										'label'    => 'Plugin',
										'required' => true,
										'options'  => A::map($plugins, function ($plugin) {
											return [
												'value' => $plugin, 
												'text'  => $plugin
											];
										})
									]
								],
								'submitButton' => 'Change',
								'value' => [
									'plugin' => $plugin
								]
							]
						];
					},
					'submit' => function () {
						return [
							'redirect' => url('/plugin/' . get('plugin'))
						];
					}	
				],
			]

		]
	]
]);

echo $kirby->render();
