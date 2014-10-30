<?php
include('common.inc.php');

$id = (int)@$_REQUEST['boek'];
if($id)
{
	// we hebben een ID, vraag de details van het boek
	$q = $conn->query("SELECT * FROM boeken WHERE id=$id");
	$boek = $q->fetch(PDO::FETCH_ASSOC);
	$q->closeCursor();
	$q = null;
}
else
{
	// we voegen een nieuw boek toe
	$boek = array();
}

// we hebben een lijst nodig van de schrijvers, elke boek heeft immers een schrijver
// we maken een dropdown box voor de schrijver
$schrijvers = array();
$q = $conn->query("SELECT * FROM schrijvers ORDER BY achternaam, voornaam");
$q->setFetchMode(PDO::FETCH_ASSOC);
while($s = $q->fetch())
{
	$schrijvers[$s['id']] = "$s[achternaam], $s[voornaam]";
}

// controleer of het formulier werd ingediend
if(@$_POST['submit'])
{
	// valideer elk veld
	$warnings = array();
	// titel mag niet leeg
	if(!$_POST['titel'])
	{
		$warnings[] = 'Geef een titel op';
	}
	// schrijver moet een sleutel zijn in de reeks $schrijvers
	if(!array_key_exists($_POST['schrijver'], $schrijvers))
	{
		$warnings[] = 'Selecteer een schrijver voor het boek';
	}
	// isbn moet een getal zijn van 10 cijfers
	if(!preg_match('~^\d{10}$~', $_POST['isbn']))
	{
		$warnings[] = 'ISBN moet 10 cijfers zijn';
	}
	// uitgever mag niet leeg zijn
	if(!$_POST['uitgever'])
	{
		$warnings[] = 'Vul een uitgever in';
	}
	// jaar moet een getal zijn
	if(!preg_match('~^\d{4}$~', $_POST['jaar']))
	{
		$warnings[] = 'Geef het jaar op in JJJJ';
	}
	// samenvatting mag niet leeg zijn
	if(!$_POST['samenvatting'])
	{
		$warnings[] = 'Geef een samenvatting van het boek';
	}
	// indien er geen fouten zijn, kan het boek toegevoegd worden
	// ingeval van een id, wordt er een update gedaan
	if(count($warnings) == 0)
	{
		if(@$boek['id'])
		{
			$sql = "UPDATE boeken SET 
					titel =" . $conn->quote($_POST['titel']) . ',
					schrijver =' . $conn->quote($_POST['schrijver']) . ',
					isbn = ' .$conn->quote($_POST['isbn']) . ',
					uitgever = ' . $conn->quote($_POST['uitgever']) . ',
					jaar = ' . $conn->quote($_POST['jaar']) . ',
					samenvatting = ' . $conn->quote($_POST['samenvatting']) .
				" WHERE id=$boek[id]";
			// echo $sql;
		}
		else
		{
			$sql = "INSERT INTO boeken(titel, schrijver, isbn, uitgever, jaar, samenvatting) VALUES ("
				. $conn->quote($_POST['titel']) .', '
				. $conn->quote($_POST['schrijver']).','
				. $conn->quote($_POST['isbn']).','
				. $conn->quote($_POST['uitgever']).','
				. $conn->quote($_POST['jaar']).','
				. $conn->quote($_POST['samenvatting']).')';
					
			// echo $sql;
		}
		// de databank updaten met try-catch blok
		try
		{
			$conn->query($sql);
			header("Location: boeken.php");
			exit();
		}
		catch(PDOException $e)
		{
			$warnings[] = "Duplicaat ISBN toegevoegd. Verbeter a.u.b.";
		}
	}
}
else
{
// formulier werd niet ingediend
$_POST = $boek;
}

toonKopTekst('Bewerk boek');
// als er waarschuwingen zijn, toon deze
if(count(@$warnings))
{
	echo "<strong>Verbeter de volgende fouten:</strong><br/>";
	foreach ($warnings as $w) {
		echo "- " ,htmlspecialchars($w), "<br/>";
	}
}
// toon het formulier
?>
<form name="formulier" method="post" action="bewerk_boek.php">
	<table border="1" cellpadding="3">
		<tr>
			<td>Titel van het boek</td>
			<td><input name="titel" type="text" value="<?=htmlspecialchars(@$_POST['titel'])?>"></td>
		</tr>
		<tr>
			<td>Schrijver</td>
			<td><select name="schrijver">
				<option value="">Selecteer uit de lijst...</option>
				<?php
				foreach ($schrijvers as $id => $schrijver) {
				?>
				<option value="<?=$id?>"
					<?= $id == @$_POST['schrijver'] ? 'selected' : '' ?>>
					<?=htmlspecialchars($schrijver)?>

				</option>
				<?php
				}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>ISBN</td>
			<td><input name="isbn" type="text" value="<?=htmlspecialchars(@$_POST['isbn'])?>"></td>
		</tr>
		<tr>
			<td>Uitgever</td>
			<td><input name="uitgever" type="text" value="<?=htmlspecialchars(@$_POST['uitgever'])?>"></td>
		</tr>
		<tr>
			<td>Jaar van uitgifte</td>
			<td><input name="jaar" type="text" value="<?=htmlspecialchars(@$_POST['jaar'])?>"></td>
		</tr>
		<tr>
			<td>Samenvatting van het boek</td>
			<td><textarea name="samenvatting"><?=htmlspecialchars(@$_POST['samenvatting'])?></textarea></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input name="submit" type="submit" value="Bewaar" />
			</td>
		</tr>
	</table>
	<?php if(@$boek['id']) { ?>
		<input name="boek" type="hidden" value="<?=$boek['id']?>">
	<?php } ?>
</form>
<!-- toon de voettekst -->
<?php toonVoetTekst(); ?>