<?php

use Kirby\Cms\Page;
use Kirby\DatabaseStorage\HasDatabaseChildren;

class CommentsPage extends Page
{
	use HasDatabaseChildren;

	public const DATABASE_CHILD_MODEL = CommentPage::class;
}
