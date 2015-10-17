<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{
$nfo = $errand->getUserErrands($user->getUser()->acronym);

$conDB['title'] = $user->getUser()->last_name . ', ' . $user->getUser()->first_name;

$conDB['main'] = <<<EOD
<div id="contactNfo">
	<fieldset>
		<legend><b>{$user->getUser()->last_name}, {$user->getUser()->first_name}</b></legend>
		<dl>
			<p><dt>{$user->getUser()->acronym}</dt></p>
			<p>
				<dt><b>Adress</b></dt>
					<dd>{$user->getUser()->adress1}</dd>
					<dd>{$user->getUser()->adress2}</dd>
					<dd>{$user->getUser()->postnr}</dd>
					<dd>{$user->getUser()->postadr}</dd>
			</p>
			<p>
				<dt><b>Telefon Nr</b></dt>
					<dd>{$user->getUser()->telnr1}</dd>
					<dd>{$user->getUser()->telnr2}</dd>
			</p>
			<p>
				<dt><b>E-Post</b></dt>
				<dd>{$user->getUser()->email}</dd>
			</p>
			<p>
				<dt><b>Institution</b></dt>
					<dd>{$user->getUser()->Institution}</dd>
			</p>
		<p><a href="user_edit.php">Redigera</a></p>
		<p><a href="user_changePassword.php">Ändra Lösenord</a></p>
	</fieldset>
</div>
<div id="errandNfo">
<fieldset>
	<legend><b>Ärenden</b></legend>
	<table style="width:65%">
		<tr>
			<th>Typ</th>
			<th>Datum & Tid</th>
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
				<td><a href="errands_edit.php?id={$val->id}"><img src="img/edit.png" style="width:24px" alt="Redigera"/></a></td>
				<td><a href="errands_remove.php?id={$val->id}"><img src="img/remove.png" style="width:20px" alt="Remove"/></a></td>
			</tr>
EOD;
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