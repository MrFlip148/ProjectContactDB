<?php
include(__DIR__.'/config.php');

$id = $_GET['id'];

$delete = isset($_POST['delete']) ? true : false;
$return = isset($_POST['return']) ? true : false;

if($delete == true)
{
	$user->removeUser($conDB['database'], $id);
}
if($return == true)
{
	header('Location: userList.php');
}

$conDB['title'] = 'Bekräfta Borttagning';

$conDB['main'] = <<<EOD
<form method = post>
	<fieldset>
		<legend>{$conDB['title']}</legend>
		<p>Vill du verkligen ta bort användaren?</p>
		<p><input type='submit' name='delete' value='Ja'/> <input type='submit' name='return' value='Nej'/></p>
	</fieldset>
</form>
EOD;

include(CONDB_THEME_PATH);