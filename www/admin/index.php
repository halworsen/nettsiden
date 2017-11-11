<?php
require __DIR__ . '/../../inc/navbar.php';
require __DIR__ . '/../../src/_autoload.php';
require_once __DIR__ . '/../../vendor/simplesamlphp/simplesamlphp/lib/_autoload.php';
require __DIR__ . '/../../sql_config.php';

$pdo = new \PDO($dbDsn, $dbUser, $dbPass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$userManager = new \pvv\admin\UserManager($pdo);

$as = new SimpleSAML_Auth_Simple('default-sp');
$as->requireAuth();
$attrs = $as->getAttributes();
$uname = $attrs['uid'][0];

$isAdmin = $userManager->isAdmin($uname);
$projectGroup = $userManager->hasGroup($uname, 'prosjekt');
$activityGroup = $userManager->hasGroup($uname, 'aktiviteter');

if(!($isAdmin | $projectGroup | $activityGroup)){
	echo 'Ingen tilgang';
	exit();
}
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="../css/normalize.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/events.css">
<link rel="stylesheet" href="../css/admin.css">

<header class="admin">Stor-&shy;gutt-&shy;leketøy</header>

<main>

<article>
	<h2>Verktøy</h2>
	<?php
		if($isAdmin | $activityGroup){
			echo '<a class="btn adminbtn" href="aktiviteter/?page=1">Aktiviteter/Hendelser</a>';
		}

		if($isAdmin | $projectGroup){
			echo '<a class="btn adminbtn" href="prosjekter/">Prosjekter</a>';
		}

		if($isAdmin){
			echo '<a class="btn adminbtn" href="brukere/">Brukere</a>';
		}
	?>
</article>

</main>

<nav>
	<?= navbar(1); ?>
	<?= loginbar(); ?>
</nav>
