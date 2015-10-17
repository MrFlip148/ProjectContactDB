<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{

$id = $_GET['id'];

$delete = isset($_POST['delete']) ? true : false;

if($delete == true)
{
	$errand->remove($id);
	header('Location:errands_all.php');
}

$conDB['title'] = 'Bekräfta Borttagning';

$conDB['main'] = <<<EOD
<form method = post>
	<fieldset>
		<legend>{$conDB['title']}</legend>
		<p>Vill du verkligen ta bort ärendet?</p>
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