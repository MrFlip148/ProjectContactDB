<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{

$id = $_GET['id'];

$res = $contact->getInfoFromId($id);
$nfo = $errand->getErrandFromContactId($id);

$conDB['title'] = $res->last_name . ', ' . $res->first_name;

$conDB['main'] = <<<EOD
<div>
	<p><a href="javascript:history.go(-1)" class="back"> &lt;&lt;&lt; Tillbaka</a></p>
</div>

<div id="contactNfo">
	<fieldset>
		<legend><b>{$conDB['title']}</b></legend>
			<p>{$res->cname}</p>
			<p>{$res->position}</p>
			<p><b>Adress</b></p>
			<p>
				{$res->adress1}</br>
				{$res->adress2}</br>
				{$res->postnr}</br>
				{$res->postadr}
			</p>
			<p><b>Telefon</b></p>
			<p>
				{$res->telnr}</br>{$res->telnrDirect}</br>{$res->mobilnr}
			</p>
			<p><b>E-Post</b></p>
				<p>{$res->email}</p>
			<a href="contacts_edit.php?id={$id}">Redigera</a><br/>
			<a href="contacts_remove.php?id={$id}">Ta Bort</a>
	</fieldset>
</div>
<div id="errandNfo">
<fieldset>
	<legend><b>Ärenden</b></legend>
	<p><a href="errands_add.php?id={$id}.0">Nytt Ärende</a></p>
	<table style="width:65%">
		<tr>
			<th>Typ</th>
			<th>Datum & Tid</th>
			<th>Skapad Av</th>

		</tr>	
EOD;
if($nfo != null)
{
	foreach($nfo as $val)
	{
		$dateTime = $val->date_errand . ' ' . substr($val->time_errand,0,5);
		$conDB['main'] .= <<<EOD
			<tr>
				<td><a href="errands_view.php?id={$val->id}">{$val->type}</a></td>
				<td>{$dateTime}</td>
				<td>{$val->createdBy}</td>
EOD;
		if($user->getUser()->acronym == $val->createdBy)
		{
			$conDB['main'] .= <<<EOD
				<td><a href="errands_edit.php?id={$val->id}"><img src="img/edit.png" style="width:24px" alt="Redigera"/></a></td>
				<td><a href="errands_remove.php?id={$val->id}"><img src="img/remove.png" style="width:20px" alt="Remove"/></a></td>
				</tr>
EOD;
		}
		else
		{
			$conDB['main'] .= <<<EOD
				</tr>
EOD;
		}
	}
}
$conDB['main'] .= <<<EOD
	</table>
</fieldset>
</div>
EOD;
}
else
{
	header('Location:index.php?error=true');
}
include(CONDB_THEME_PATH);