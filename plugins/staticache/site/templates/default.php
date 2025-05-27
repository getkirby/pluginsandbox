<h1>Staticache Plugin: <?= $page->title() ?></h1>

<ul>
  <li><a href="/">Home</a></li>
  <li><a href="/test">Test</a></li>
  <li><a href="/ignore">Ignore</a></li>
</ul>

<p>Last update: <?= date('Y-m-d H:i:s') ?></p>

<ul>
  <li><a href="/cache/?id=<?= $page->id() ?>">View cache file</a></li>
  <li><a href="/cache/flush">Flush cache</a></li>
</ul>