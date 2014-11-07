<?php
include('common.inc.php');

$q = $conn->query("SELECT * FROM schrijvers ORDER BY achternaam, voornaam");
$q->setFetchMode(PDO::FETCH_ASSOC);

toonKopTekst('Schrijvers');

?>
<table width="60%" border="1" cellpadding="3">
	<tr>
		<th>Voornaam</th>
		<th>Achternaam</th>
		<th>Biografie</th>
		<th>Bewerken</th>
	</tr>
	<?php
	while($r = $q->fetch())
	{
		?>
		<tr>
			<td><?=htmlspecialchars($r['voornaam'])?></td>
			<td><?=htmlspecialchars($r['achternaam'])?></td>
			<td><?=htmlspecialchars($r['biografie'])?></td>
			<td>
				<a href="bewerk_schrijver.php?schrijver=<?=$r['id']?>">Bewerk</a>
			</td>
		</tr>
		<?php
	}
	?>
</table>
<div>
	<hr/>
	<a href="bewerk_schrijver.php">Nieuwe schrijver toevoegen</a>
</div>
<?php
toonVoetTekst();
?>