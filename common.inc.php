<?php
$connStr = 'mysql:host=localhost;dbname=bibliotheek';
$user = 'beheerder';
$password = 'beheerder';

function toonKopTekst($title)
{
	?>
	<!DOCTYPE html>
	<html>
	<head>
	  <meta charset='UTF-8'>
	  <title><?=htmlspecialchars($title)?></title>
	</head>
	<body>
		<header>
			<h1><?=htmlspecialchars($title)?></h1>
			<nav>
				<a href='boeken.php'>Boeken</a>
				<a href='schrijvers.php'>Schrijvers</a>
			</nav>
		</header>
		<hr/>
<?php
}

function toonVoetTekst()
{
?>
	</body>
	</html>
<?php
}

$conn = new PDO($connStr, $user, $password);