<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{

$res = $errand->getAll();

$conDB['title'] = 'Alla Ärenden';

$conDB['main'] = <<<EOD
<table>
	<tr>
		<th></th>
		<th>Typ av Ärende</th>
		<th>Datum & Tid</th>
		<th>Relaterad Kontakt</th>
		<th>Författare</th>
		<th>Skapad</th>
	</tr>
EOD;

foreach($res as $val)
{
	$dateTime = $val->date_errand . ' , ' . substr($val->time_errand,0,5);
	$conDB['main'] .= <<<EOD
	<tr>
		<td>§</td>
		<td><a href='errands_view.php?id={$val->id}'>{$val->type}</a></td>
		<td>{$dateTime}</td>
		<td><a href="contacts_view.php?id={$val->cID}">{$val->last_name}, {$val->first_name}</td>
		<td>{$val->createdBy}</td>
		<td>{$val->timeCreated}</td>
	</tr>
EOD;
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