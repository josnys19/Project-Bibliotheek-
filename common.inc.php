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
				<a href='index.php'>Startpagina</a>
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

function toonFout($message)
{
	echo "<h2>Fout</h2>";
	echo nl2br(htmlspecialchars($message));
	toonVoetTekst();
	exit();
}

try
{
	$conn = new PDO($connStr, $user, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	toonKopTekst('Fout');
	toonFout("Sorry, er is een fout opgetreden. Probeer later opnieuw" . $e->getMessage());
}
?>