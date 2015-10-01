<?php 
include(__DIR__.'/config.php');

$id = $_GET['id'];

$res = $app->getAppointmentFromId($id);

$conDB['title'] = $res->type . " " . $res->dateOfCase;

$conDB['main'] = <<<EOD
<a href="javascript:history.go(-1)"> &lt;&lt;&lt; Tillbaka</a>
<fieldset>
	<legend>{$conDB['title']}</legend>
	<p>{$res->type}</p>
	<p>När: {$res->dateOfCase} {$res->timeOfCase}</p>
	<p>Vem: {$res->relContact} @ {$res->relCompany}</p>
	<p>Noteringar: <br/>{$res->content}</p>
	<br/>
	<p>Skapad Av: {$res->createdBy} </p>
	<p>Skapad: {$res->timeCreated}</p>
	<p>Senast Redigerad: {$res->lastEdited}</p>
	<br/>
	<p><a href="appointmentsEdit.php?id={$res->id}">Redigera</a></p>
	<p><a href="appointmentsRemove.php?id={$res->id}">Ta Bort</a></p>
</fieldset>

EOD;
include(CONDB_THEME_PATH);