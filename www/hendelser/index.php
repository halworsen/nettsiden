<?php namespace pvv\side;
require_once dirname(dirname(__DIR__)) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'include.php']);

$translation = ['I dag', 'I morgen', 'Denne uka', 'Neste uke', 'Denne måneden', 'Neste måned'];
?>
<!DOCTYPE html>
<html lang="no">
<title>Hendelsesverkstedet</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
<link rel="stylesheet" href="../css/normalize.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/events.css">

<header>Hendelses&shy;verk&shy;stedet</header>

<main>
<article>

<?php
$description_paragraphs = 1; //description length
foreach($agenda->getNextDays() as $period => $events) {
	if ($events) { ?>
		<h2><?= $translation[$period] ?></h2>
		<ul class="events">
		<?php foreach($events as $event) {?>
		<li style="border-color: <?= $event->getColor() ?>">
			<h4><strong>
				<?php if ($event->getURL()) { ?>
					<a href="<?= $event->getURL() ?>"><?= $event->getName() ?></a>
				<?php } else { ?>
					<?= $event->getName() ?>
				<?php } ?>
			</strong></h4>

			<?php $description = $event->getDescription(); ?>
			<?php if ($description_paragraphs) array_splice($description, $description_paragraphs); ?>
			<p><?= implode($description, "<br>") ?></p>

			<ul class="subtext">
				<li>Tid: <strong><?= Agenda::getFormattedDate($event->getStart()) ?></strong>
				<li>Sted: <strong><?= $event->getLocation() ?></strong>
				<li>Arrangør: <strong><?= $event->getOrganiser() ?></strong>
			</ul>

		<?php } ?>
		</ul>
	<?php } ?>
<?php } ?>
</article>

</main>

<nav>
	<?= navbar(1, 'hendelser'); ?>
	<?= loginbar($sp, $pdo); ?>
</nav>