<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{

$id = $_GET['id'];

$co = $contact->getCompanyIdFromContactId($id);

$delete = isset($_POST['delete']) ? true : false;

if($delete == true)
{
	$contact->remove($id);
	header('Location:contacts_all.php');
}

$conDB['title'] = 'Bekräfta Borttagning';

$conDB['main'] = <<<EOD
<form method = post>
	<fieldset>
		<legend>{$conDB['title']}</legend>
		<p>Vill du verkligen ta bort kontakten?</p>
		<p><input type='submit' name='delete' value='Ja'/> <input type='submit' name='return' value='Nej' onClick='javascript:history.go(-1)'/></p>
	</fieldset>
</form>
EOD;

}
else
{
	header('Location:index.php?error=true');
}
include(CONDB_THEME_PATH);