<?php

use Kirby\Content\VersionId;

return [
	'cache' => [
		'pages' => [
			'active' => true,
			'type'   => 'static', 
			'ignore' => ['ignore']
		]
	], 
	'routes' => [
		[
			'pattern' => 'cache',
			'action' => function () {
				$id   = get('id');
				$page = page($id);

				if (!$page) {
					return false;
				}

				// make Page::cacheId() accessible
				$cacheIdMethod = new ReflectionMethod('Kirby\Cms\Page', 'cacheId');
				$cacheIdMethod->setAccessible(true);

				$cacheId = $cacheIdMethod->invoke($page, 'html', VersionId::latest());

				// get the cache content
				$cache   = kirby()->cache('pages');
				$content = $cache->get($cacheId);

				// make StatiCache::file() accessible
				$fileMethod = new ReflectionMethod('Kirby\Cache\StatiCache', 'file');
				$fileMethod->setAccessible(true);

				$file = $fileMethod->invoke($cache, $cacheId);

				$content = htmlspecialchars($content ?? '');
				
				return <<<HTML
					<h1>Cache for $id</h1>

					<h2>Location</h2>
					<p>$file</p>

					<h2>Output</h2>
					<code><pre>$content</pre></code>
				HTML;
			}
		],	
		[
			'pattern' => 'cache/flush',
			'action' => function () {
				kirby()->cache('pages')->flush();
				return 'Cache flushed';
			}
		]
	]
];