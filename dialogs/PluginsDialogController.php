<?php

use Kirby\Panel\Controller\DialogController;
use Kirby\Panel\Ui\Dialog;
use Kirby\Panel\Ui\Dialog\FormDialog;
use Kirby\Toolkit\A;

/**
 * Controls the Panel dialog to switch
 * between the plugin test setups
 */
class PluginsDialogController extends DialogController
{
	public function __construct(
		protected array $plugins,
		protected string $current
	) {
		parent::__construct();
	}

	public function load(): Dialog
	{
		return new FormDialog(
			fields: [
				'plugin' => [
					'type'     => 'select',
					'label'    => 'Plugin',
					'required' => true,
					'empty'    => false,
					'options'  => A::map($this->plugins, fn ($plugin) => [
						'value' => $plugin,
						'text'  => $plugin
					])
				]
			],
			submitButton: $this->i18n('change'),
			value: [
				'plugin' => $this->current
			]
		);
	}

	public function submit(): array
	{
		return [
			'redirect' => url('plugin/' . $this->request->get('plugin'))
		];
	}
}
