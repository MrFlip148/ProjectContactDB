<?php 

include(__DIR__.'/config.php');

$res = $contact->getContacts();

$conDB['title'] = 'Kontakter';

$conDB['main'] = <<<EOD
<p><a href="contactsAdd.php">Ny Kontakt</a></p>
<table border=1>
	<tr>
		<td>Namn</td>
		<td>Företag</td>
		<td>Telefon</td>
		<td>E-Post</td>
		<td>Senast Ärende</td>
	</tr>
EOD;

foreach($res as $val)
{
	$conDB['main'] .= <<<EOD
	<tr>
		<td>{$val->name}</td>
		<td>{$val->company}</td>
		<td>{$val->telnr1}</td>
		<td>{$val->email}</td>
EOD;
	$nfo = $app->getLatestCaseForRelContact($val->name);
	if($nfo != null)
	{
		$dateTime = $nfo->dateOfCase . $nfo->timeOfCase;
		$conDB['main'] .= <<<EOD
			<td><a href="appointmentsView.php?id={$nfo->id}">{$nfo->type} {$dateTime}</a></td>
EOD;
	}
	else
	{
		$conDB['main'] .= <<<EOD
			<td></td>
EOD;
	}
	$conDB['main'] .= <<<EOD
		<td><a href="contactsView.php?id={$val->id}">Visa Kontakt Info</a></td>
		<td><a href="contactsEdit.php?id={$val->id}"><img src="img/edit.png" style="width:24px" alt="Redigera"/></a></td>
		<td><a href="contactsRemove.php?id={$val->id}"><img src="img/remove.png" style="width:20px" alt="Remove"/></a></td>
	</tr>
EOD;
}

$conDB['main'] .= <<<EOD
</table>
EOD;
include(CONDB_THEME_PATH);