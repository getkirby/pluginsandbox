<?php

use Kirby\Database\Database;

return [
	'database' => [
		'comments' => new Database([
			'type'     => 'sqlite',
			'database' => dirname(__DIR__) . '/db/comments.sqlite'
		])
	]
];
