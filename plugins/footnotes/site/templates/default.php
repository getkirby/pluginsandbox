<h1><?= $site->title() ?></h1>

<section>
<h3>With footnotes</h3>
<?= $site->text()->footnotes() ?>
</section>

<section>
<h3>Without footnotes</h3>
<?= $site->text()->removeFootnotes() ?>
</section>