<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{

$id = $_GET['id'];

$delete = isset($_POST['delete']) ? true : false;
$return = isset($_POST['return']) ? true : false;

if($delete == true)
{
	$user->remove($id);
	header('Location: user_list.php');
}
if($return == true)
{
	header('Location: user_list.php');
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
}
else
{
	header('Location:index.php?error=true');
}
include(CONDB_THEME_PATH);