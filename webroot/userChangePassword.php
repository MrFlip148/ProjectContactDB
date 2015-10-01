<?php
include(__DIR__.'/config.php');

$id = $user->getUserId();
$pass1 = isset($_POST['pass1']) ? $_POST['pass1'] : null;
$pass2 = isset($_POST['pass2']) ? $_POST['pass2'] : null;
$password = $user->getUserPassword();
$output = null;

$save = isset($_POST['save']) ? true : false;

if($save == true)
{
	if($pass1 == $pass2)
	{
		$password = $pass1;
		$user->changePassword($conDB['database'], $password, $id);
	}
	else
	{
		$output = "Fälten är inte lika. Båda fälten måste vara lika.";
	}
}

$conDB['title'] = "Uppdatera Konto";

$conDB['main'] = <<<EOD

<a href="javascript:history.go(-1)"> &lt;&lt;&lt; Tillbaka</a>

<form method=post>
	<fieldset>
		<legend>{$conDB['title']}</legend>
		<input type='hidden' name='id' value='{$id}'/>
		<p><label>Nytt Lösenord:<br/><input type='text' name='pass1' value='{$pass1}'/></label></p>
		<p><label>Repetera Lösenord:<br/><input type='text' name='pass2' value='{$pass2}'/></label></p>
		<p><output><b>{$output}</b></output></p>
		<p><input type='submit' name='save' value='Spara'/> <input type='reset' value='Återställ'/></p>
	</fieldset>
</form>

EOD;

include(CONDB_THEME_PATH);