<?php 
include(__DIR__.'/config.php');

$res = $app->getAppointments();

$conDB['title'] = 'Ärenden';

$conDB['main'] = <<<EOD
<p><a href="appointmentsAdd.php">Nytt Ärende</a></p>
<table border=1>
	<tr>
		<td>Ärende</td>
		<td>Kontakt</td>
		<td>Skapare</td>
	</tr>
EOD;

foreach($res as $val)
{
	$conDB['main'] .= <<<EOD
	<tr>
		<td><a href="appointmentsView.php?id={$val->id}">{$val->type} {$val->dateOfCase}</a></td>
		<td>{$val->relContact} @ {$val->relCompany}</td>
		<td>{$val->createdBy}</td>
		<td><a href="appointmentsEdit.php?id={$val->id}"><img src="img/edit.png" style="width:24px" alt="Redigera"/></a></td>
		<td><a href="appointmentsRemove.php?id={$val->id}"><img src="img/remove.png" style="width:20px" alt="Remove"/></a></td>
	</tr>
EOD;
}

$conDB['main'] .= <<<EOD
</table>
EOD;
include(CONDB_THEME_PATH);