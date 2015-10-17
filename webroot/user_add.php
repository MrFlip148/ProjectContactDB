<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{
function generatePassword($length = 8)
{
	$possibleChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	$pass = '';
	for($i = 0; $i < $length; $i++)
		{
			$rand = rand(0, strlen($possibleChars) - 1);
			$pass .= substr($possibleChars, $rand, 1);
		}
	return $pass;
}

$acro = isset($_POST['acro']) ? $_POST['acro'] : null;
$pass = isset($_POST['pass']) ? $_POST['pass'] : generatePassword();

$save = isset($_POST['save']) ? true : false;

if($save == true)
{
	$user->add($acro);
	$user->addPassword($pass, $acro);
	header('Location: user_list.php');
}

$conDB['title'] = 'Ny Användare';

$conDB['main'] = <<<EOD

<p><a href="javascript:history.go(-1)" class="back"> &lt;&lt;&lt; Tillbaka</a></p>

<form method=post>
	<fieldset>
		<legend>{$conDB['title']}</legend>
		<input type='hidden' name='id' value=/>
		<p><label>Akronym:<br/><input type='text' name='acro' value='{$acro}'/></label></p>
		<p><label>Lösenord:<br/><input type='text' name='pass' value='{$pass}'/></label></p>
		<p>Notera lösenordet, så användaren kan logga in.</p>
		<p><input type='submit' name='save' value='Spara'/></p>
	</fieldset>
</form>

EOD;

}
else
{
	header('Location:index.php?error=true');
}
include(CONDB_THEME_PATH);