<!DOCTYPE html>
<?php
date_default_timezone_set('Europe/Oslo');
setlocale(LC_ALL, 'no_NO');
require __DIR__ . '/../../src/_autoload.php';
require __DIR__ . '/../../sql_config.php';
?>
<html lang="no">
<title>Sosialverkstedet</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
<link rel="stylesheet" href="../css/normalize.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/events.css">

<nav>
	<li><a href="../index.php">hjem</a></li>
	<li><a href="../kurs/index.html">kurs</a></li>
	<li><a href="../prosjekt/index.html">prosjekt</a></li>
	<li class="active"><a href="../sosiale/index.html">sosiale</a></li>
	<li><a href="../wiki/index.html">wiki</a></li>
</nav>

<header>Sosial&shy;verk&shy;stedet</header>

<main>

<?php
$activity = new \pvv\side\social\AnimekveldActivity;
$nextEvent = $activity->getNextEventFrom(new DateTimeImmutable);
?>

<article>
	<h2><img src="../sosiale/animekveld.jpg"><em><?= $nextEvent->getRelativeDate()?></em> Animekveld</h2>
	<ul class="subtext">
        <li>Tid:
        <strong>
            <?= $nextEvent->getStart()->format('Y-m-d H:i');?>
        </strong>
		<li>Sted:
        <strong>
            <?= $nextEvent->getLocation();?>
        </strong>
		<li>Arrangør:
        <strong>
            <?= $nextEvent->getOrganiser();?>
        </strong>
	</ul>
	<p>Er du glad i japansk tegnefilm eller er du bare nysgjerrige på hva animeer er? Bli med oss. Hver fredag finner vi de nyeste episodene og ser på dem mens vi nyter noe godt. Vi viser denne senongens nye animeer.

	<p>Alle kan være med på å anbefale eller veto serier.

	<p><a class="btn" href="http://anichart.net/">Sesongoversikten</a>

	<p><a class="btn" href="#">Påminn meg</a>
</article>

</main>
