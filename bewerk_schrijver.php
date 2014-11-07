<?php
include("common.inc.php");

// kijken of we een schrijversId gekregen hebben
@$id = (int)$_REQUEST['schrijver'];
if($id)
{
	// we hebben een id en halen de details op
	$q = $conn->query("SELECT * FROM schrijvers WHERE id=$id");
	$schrijver = $q->fetch(PDO::FETCH_ASSOC);
	$q->closeCursor();
	$q = null;
}
else
{
	// we voegen een nieuw boek toe
	$schrijver = array();
}

// controle of het formulier ingediend werd
if(@$_POST['submit'])
{
	// valideer elk veld
	$warnings = array();
	// voornaam mag niet leeg zijn
	if(!$_POST['voornaam'])
	{
		$warnings[] = 'Vul de voornaam in';
	}
	// achternaam mag niet leeg zijn
	if(!$_POST['achternaam'])
	{
		$warnings[] = 'Vul de achternaam in';
	}
	// biografie mag niet leeg zijn
	if(!$_POST['biografie'])
	{
		$warnings[] = 'Vul de biografie in';
	}

	// indien er geen fouten zijn, kunnen we de database updaten
	if(count($warnings) == 0)
	{
		if(@$schrijver['id'])
		{
			$sql = "UPDATE schrijvers SET voornaam = "
					. $conn->quote($_POST['voornaam']) . ' ,
					achternaam = ' . $conn->quote($_POST['achternaam']) . ' ,
					biografie = ' . $conn->quote($_POST['biografie']) . "
					WHERE id=$schrijver[id]";
		}
		else
		{
			$sql = "INSERT INTO schrijvers(voornaam, achternaam, biografie) VALUES ("
				. $conn->quote($_POST['voornaam']) . ' , '
				. $conn->quote($_POST['achternaam']) . ' ,'
				. $conn->quote($_POST['biografie']) . ')';
		}
		$conn->query($sql);
		header("Location: schrijvers.php");
		exit();
	}
}
else
{
	// het formulier werd niet ingediend
	$_POST = $schrijver;
}
// toon de koptekst
toonKopTekst("Bewerk schrijver");

// toon eventuele fouten
if(count(@$warnings))
{
	echo "<strong>Verbeter de volgende fouten:</strong><br/>";
	foreach ($warnings as $w) {
		echo "- " . htmlspecialchars($w). "<br>";
	}
}
// toon het formulier
?>
<form name="formulier" method="post" action="bewerk_schrijver.php">
	<table border="1" width="60%" cellpadding="3">
		<tr>
			<th>Voornaam</th>
			<td>
				<input type="text" name="voornaam" value="<?=htmlspecialchars(@$_POST['voornaam'])?>">
			</td>
		</tr>
		<tr>
			<th>Achternaam</th>
			<td>
				<input type="text" name="achternaam" value="<?=htmlspecialchars(@$_POST['achternaam'])?>">
			</td>
		</tr>
		<tr>
			<th>Biografie</th>
			<td>
				<textarea name="biografie"><?=htmlspecialchars(@$_POST['biografie'])?></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" value="Bewaar" />
			</td>
		</tr>
	</table>
	<?php 
	if(@$schrijver['id'])
	{
		?>
		<input name="schrijver" type="hidden" value="<?=$schrijver['id']?>">
		<?php
	}
	?>
</form>
<div>
	<hr/>
	<a href="bewerk_schrijver.php">Nieuwe schrijver toevoegen</a>
</div>
<?php 
// toon voettekst
toonVoettekst();
?>





