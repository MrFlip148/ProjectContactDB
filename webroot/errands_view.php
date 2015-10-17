<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{

$id = $_GET['id'];

$res = $errand->getErrandFromSelfId($id);

$dateTime = $res->date_errand . ' , ' . substr($res->time_errand,0,5);

$conDB['title'] = $res->type . " " . $res->date_errand;

$conDB['main'] = <<<EOD
<p><a href="javascript:history.go(-1)" class="back"> &lt;&lt;&lt; Tillbaka</a></p>
<fieldset>
	<legend>{$conDB['title']}</legend>
	<p>{$res->type}</p>
	<p>{$dateTime}</p>
	<p>{$res->last_name}, {$res->first_name} <br/> {$res->cname}</p>
	<p>Noteringar: <br/>{$res->content}</p>
	<br/>
	<p>Skapad Av: {$res->createdBy} </p>
	<p>Skapad: {$res->timeCreated}</p>
	<p>Senast Redigerad: {$res->lastEdited}</p>
EOD;
if($res->createdBy == $user->getUser()->acronym)
{
	$conDB['main'] .= <<<EOD
		<p><a href="errands_edit.php?id={$id}">Redigera</a></p>
		<p><a href="errands_remove.php?id={$id}">Ta Bort</a></p>
EOD;
}
$conDB['main'] .= <<<EOD
</fieldset>
EOD;
}
else
{
	header('Location:index.php?error=true');
}
include(CONDB_THEME_PATH);