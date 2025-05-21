<?php

use Uniform\Form;

return function ($kirby) {
    $form = new Form([
        'email' => [
            'rules' => ['required', 'email'],
            'message' => 'Please enter a valid email address',
        ],
        'message' => [
            'rules' => ['required'],
            'message' => 'Please enter a message',
        ],
    ]);

    if ($kirby->request()->is('POST')) {
        $form->logAction([
            'file' => kirby()->root('logs') . '/messages.log',
        ]);
    }

    return compact('form');
};
