<?php
include('common.inc.php');

$id = (int)$_REQUEST['id'];
$q = $conn->query("SELECT * FROM schrijvers WHERE id=$id");
$schrijver = $q->fetch(PDO::FETCH_ASSOC);
$q->closeCursor();

if(!$schrijver)
{
	toonKopTekst('Fout');
	echo "Er werd een foutief id doorgegeven.";
	toonVoetTekst();
	exit;
}

toonKopTekst("Schrijver: $schrijver[voornaam] $schrijver[achternaam]");

// haal al de boeken op
$q = $conn->query("SELECT * FROM boeken WHERE schrijver=$id ORDER BY titel");
$q->setFetchMode(PDO::FETCH_ASSOC);
// toon alles
?>
<h2>Schrijver</h2>
<table width="60%" border="1" cellpadding="3">
	<tr>
		<th>Voornaam</th>
		<td><?=htmlspecialchars($schrijver['voornaam'])?></td>
	</tr>
	<tr>
		<th>Achternaam</th>
		<td><?=htmlspecialchars($schrijver['achternaam'])?></td>
	</tr>
	<tr>
		<th>Biografie</th>
		<td><?=htmlspecialchars($schrijver['biografie'])?></td>
	</tr>
</table>

<h2>Boeken</h2>
<table width="60%" border="1" cellpadding="3">
	<tr>
		<th>Titel</th>
		<th>ISBN</th>
		<th>Uitgever</th>
		<th>Jaar</th>
		<th>Samenvatting</th>
	</tr>
	<?php
	while($r = $q->fetch())
	{
		?>
		<tr>
			<td><?=htmlspecialchars($r['titel'])?></td>
			<td><?=htmlspecialchars($r['isbn'])?></td>
			<td><?=htmlspecialchars($r['uitgever'])?></td>
			<td><?=htmlspecialchars($r['jaar'])?></td>
			<td><?=htmlspecialchars($r['samenvatting'])?></td>
		</tr>
		<?php
	}
	?>
</table>
<?php
toonVoetTekst();






