<?php
return [
	'timnarr.imagex' => [
		'cache'                => true,
		'customLazyloading'    => false,
		'formats'              => ['avif', 'webp'],
		'includeInitialFormat' => false,
		'noSrcsetInImg'        => false,
		'relativeUrls'         => false,
	],
	'thumbs' => [
		'driver'  => 'im',
		'bin'     => '/opt/homebrew/bin/convert',
		'srcsets' => [
			'my-srcset' => [ // preset for jpeg and png
				'400w'  => ['width' =>  400, 'crop' => true, 'quality' => 80],
				'800w'  => ['width' =>  800, 'crop' => true, 'quality' => 80],
				'1200w' => ['width' => 1200, 'crop' => true, 'quality' => 80],
			],
			'my-srcset-webp' => [ // preset for webp
				'400w'  => ['width' =>  400, 'crop' => true, 'quality' => 75, 'format' => 'webp', 'sharpen' => 10],
				'800w'  => ['width' =>  800, 'crop' => true, 'quality' => 75, 'format' => 'webp', 'sharpen' => 10],
				'1200w' => ['width' => 1200, 'crop' => true, 'quality' => 75, 'format' => 'webp', 'sharpen' => 10],
			],
			'my-srcset-avif' => [ // preset for avif
				'400w'  => ['width' =>  400, 'crop' => true, 'quality' => 65, 'format' => 'avif', 'sharpen' => 25],
				'800w'  => ['width' =>  800, 'crop' => true, 'quality' => 65, 'format' => 'avif', 'sharpen' => 25],
				'1200w' => ['width' => 1200, 'crop' => true, 'quality' => 65, 'format' => 'avif', 'sharpen' => 25],
			],  
		],
	],
];