<body>
	<?php foreach ($site->images() as $image) : ?>
		<?php snippet('imagex-picture', [
			'image' => $image,
			'imgAttributes' => [
				'shared' => [
					'class'    => 'my-image',
					'decoding' => 'async',
					'sizes'    => '100vw',
				],
			],
			'ratio'      => '16/9',
			'srcsetName' => 'my-srcset',
			'critical'   => false,
		]) ?>
	<?php endforeach ?>
</body>