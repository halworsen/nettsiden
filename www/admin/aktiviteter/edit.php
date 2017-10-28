<?php
ini_set('display_errors', '1');
date_default_timezone_set('Europe/Oslo');
setlocale(LC_ALL, 'no_NO');
error_reporting(E_ALL);
require __DIR__ . '/../../../src/_autoload.php';
require __DIR__ . '/../../../sql_config.php';
require_once(__DIR__ . '/../../../vendor/simplesamlphp/simplesamlphp/lib/_autoload.php');
$as = new SimpleSAML_Auth_Simple('default-sp');
$attrs = $as->getAttributes();
$pdo = new \PDO($dbDsn, $dbUser, $dbPass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$customActivity = new \pvv\side\DBActivity($pdo);

$new = 0;
if(isset($_GET['new'])){
	$new = $_GET['new'];
}

$eventID = 0;
if(isset($_GET['id'])){
	$eventID = $_GET['id'];
}else if($new == 0){
	echo "\nID not set";
	exit();
}

$today = new DateTimeImmutable;
$defaultStart = $today->format("Y-m-d H:00:00");
$inOneHour = $today->add(new DateInterval('PT1H'));
$defaultEnd = $inOneHour->format("Y-m-d H:00:00");

$event = new \pvv\side\SimpleEvent(
	0,
	'Kul Hendelse',
	$today,
	$inOneHour,
	'PVV',
	'Norge et sted',
	'her skjer det noe altså'
);
if($new == 0){
	$event = $customActivity->getEventByID($eventID);
}
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../../css/normalize.css">
<link rel="stylesheet" href="../../css/style.css">
<link rel="stylesheet" href="../../css/events.css">
<link rel="stylesheet" href="../../css/admin.css">

<nav>
	<ul>
	<li><a href="../">hjem</a></li>
	<li><a href="../kalender/">kalender</a></li>
	<li><a href="../aktiviteter/">aktiviteter</a></li>
	<li><a href="../prosjekt/">prosjekter</a></li>
	<li><a href="../kontakt/">kontakt</a></li>
	<li><a href="../pvv/">wiki</a></li>
	</ul>

	<?php
		$attr = $as->getAttributes();
		if($attr){
			$uname = $attr["uid"][0];
			echo '<p class="login">logget inn som: ' . $uname . '</p>';
		}else{
			echo '<a class="login" href="' . $as->getLoginURL() . '">logg inn</a>';
		}
	?>
</nav>

<header class="admin">Aktivitets&shy;administrasjon</header>

<main>

<article>
	<h2><?= ($new == 1 ? "Ny hendelse" : "Rediger hendelse"); ?></h2>

	<form action="update.php", method="post" class="gridsplit5050">
		<div class="gridl">
			<p class="subtitle">Tittel</p>
			<?= '<input type="text" name="title" value="' . $event->getName(). '" class="boxinput">' ?><br>

			<p class="subtitle">Beskrivelse</p>
			<textarea name="desc" cols="40" rows="5" class="boxinput"><?= implode($event->getDescription(), "\n"); ?></textarea>
		</div>

		<div class="gridr noborder">
			<p class="subtitle">Starttid (YYYY-MM-DD HH:MM:SS)</p>
			<?= '<input name="start" type="text"  class="boxinput" value="' . $event->getStart()->format('Y-m-d H:00:00') . '"><br>' ?>

			<p class="subtitle">Sluttid (YYYY-MM-DD HH:MM:SS)</p>
			<?= '<input name="end" type="text"  class="boxinput" value="' . $event->getStop()->format('Y-m-d H:00:00') . '"><br>' ?>

			<p class="subtitle">Organisert av</p>
			<?= '<input type="text" name="organiser" value="' . $event->getOrganiser(). '" class="boxinput">' ?><br>

			<p class="subtitle">Hvor?</p>
			<?= '<input type="text" name="location" value="' . $event->getLocation(). '" class="boxinput">' ?><br>
		</div>

		<?= '<input type="hidden" name="id" value="' . $event->getID() . '" />' ?>

		<div class="allgrids" style="margin-top: 2em;">
			<hr class="ruler">

			<input type="submit" class="btn" value="Lagre"></a>
		</div>
	</form>

	

	<p>
</article>

</main>
