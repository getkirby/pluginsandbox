<?php

use Kirby\DatabaseStorage\DatabasePage;

class CommentPage extends DatabasePage
{
	public const DATABASE_NAME = 'comments';
	public const DATABASE_TABLE = 'comments';
	public const DATABASE_FIELDS = [
		'text',
		'email',
	];
}
