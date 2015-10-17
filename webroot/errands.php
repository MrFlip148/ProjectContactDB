<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{

$id = $_GET['id'];

$res = $errand->getErrandFromCompanyId($id);

$conDB['title'] = 'Ärrenden';

$conDB['main'] = <<<EOD
<p><p><a href="javascript:history.go(-1)" class="back"> &lt;&lt;&lt; Tillbaka</a></p>
<p><a href="errands_add.php?id={$id}.5">Nytt Ärende</a></p>
<table>
	<tr>
		<th>Typ av Ärende</th>
		<th>Datum & Tid</th>
		<th>Gällande Kontakt</th>
		<th>Skapad Av</th>
	</tr>
EOD;
if($res != null)
{
foreach($res as $val)
{
	$dateTime = $val->date_errand . ' , ' . substr($val->time_errand,0,5);
	$conDB['main'] .= <<<EOD
	<tr>
		<td><a href='errands_view.php?id={$val->id}'>{$val->type}</a></td>
		<td>{$dateTime}</td>
		<td><a href="contacts_view.php?id={$val->cID}">{$val->last_name}, {$val->first_name}</td>
		<td>{$val->createdBy}</td>
	</tr>
EOD;
}
}

$conDB['main'] .= <<<EOD
</table>
EOD;
}
else
{
	header('Location:index.php?error=true');
}
include(CONDB_THEME_PATH);