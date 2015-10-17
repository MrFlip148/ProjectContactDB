<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{

$id = $_GET['id'];

$conDB['title'] = $contact->getCompanyNameFromId($id)->cname;

$conDB['main'] = <<<EOD
<p><a href="javascript:history.go(-1)" class="back"> &lt;&lt;&lt; Tillbaka</a></p>

<p><a href="contacts.php?id={$id}">Kontakt Lista</a></p>

<p><a href="errands.php?id={$id}">Ärende Lista</a></p>

EOD;
}
else
{
	header('Location:index.php?error=true');
}
include(CONDB_THEME_PATH);