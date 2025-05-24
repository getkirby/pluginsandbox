<?php

use Kirby\Geo\Geo;

Kirby::plugin('getkirby/geo-site-methods', [
	'siteMethods' => [
		'distance' => function () {
			$mannheim = Geo::point(49.4883333, 8.4647222);
			$hamburg  = Geo::point(53.553436, 9.992247);

			return Geo::distance($mannheim, $hamburg);
		},
		'niceDistance' => function () {
			$mannheim = Geo::point(49.4883333, 8.4647222);
			$hamburg  = Geo::point(53.553436, 9.992247);

			return Geo::niceDistance($mannheim, $hamburg);
		}
	]
]);