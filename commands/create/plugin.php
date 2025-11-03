<?php

use Kirby\CLI\CLI;
use Kirby\Data\Data;
use Kirby\Filesystem\Dir;
use Kirby\Toolkit\Str;

return [
	'args' => [
		'name' => [
			'description' => 'The name for the plugin',
		]
	],
	'command' => function (CLI $cli) {
		$cli->kirby();

		$name = $cli->argOrPrompt('name', 'Enter a name for the plugin:');
		$slug = Str::slug($name);
		$dir  = $cli->dir('plugins') . '/' . $slug;

		if (is_dir($dir) === true) {
			throw new Exception('The plugin already exists');
		}

		Dir::make($dir);

		Dir::make($dir . '/content');
		Dir::make($dir . '/content/home');

		Dir::make($dir . '/site');
		Dir::make($dir . '/site/plugins');
		Dir::make($dir . '/site/plugins/' . $slug);

		Data::write($dir . '/content/site.txt', [
			'title' => $name . ' Plugin'
		]);

		Data::write($dir . '/content/home/home.txt', [
			'title' => 'Home'
		]);

		$cli->success('The plugin has been created: ' . $dir);
	}
];
