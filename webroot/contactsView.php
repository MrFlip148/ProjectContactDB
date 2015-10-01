<?php 

include(__DIR__.'/config.php');

$id = $_GET['id'];

$res = $contact->getContactFromId($id);

$conDB['title'] = $res->name;

$conDB['main'] = <<<EOD
<a href="javascript:history.go(-1)"> &lt;&lt;&lt; Tillbaka</a>

<fieldset>
	<legend>{$conDB['title']}</legend>
	<dl>
		<dt><dd><p>{$res->company}</p><dd>
		<dt><dd><p>{$res->position}</p><dd>
		<dt><p><b>Adress</b></dt>
			<dd>{$res->adress1}</dd>
			<dd>{$res->adress2}</dd>
			<dd>{$res->postnr}</dd>
			<dd>{$res->postadr}</dd>
		<dt><p><b>Telefon</b></dt>
			<dd>{$res->telnr1}</dd>
			<dd>{$res->telnr2}</dd>
		<dt><p><b>E-Post</b></dt>
			<dd>{$res->email}</dd>
	</dl>
	<p><a href="appointmentsAdd.php?id={$id}">Nytt Ärende med denna kontakt</a></p>
	<p><a href="contactsEdit.php?id={$id}">Redigera</a></p>
	<p><a href="contactsRemove.php?id={$id}">Ta Bort</a></p>
</fieldset>
EOD;

include(CONDB_THEME_PATH);