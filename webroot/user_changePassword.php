<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{

$id 		= isset($_POST['id']) 		? $_POST['id'] 		: $user->getUser()->id;
$pass1 		= isset($_POST['pass1']) 	? $_POST['pass1'] 	: null;
$pass2 		= isset($_POST['pass2']) 	? $_POST['pass2'] 	: null;
$save 		= isset($_POST['save']) 	? true 				: false;
$password 	= $user->getUser()->password;
$output 	= null;

if($save == true)
{
	if($pass1 == $pass2)
	{
		$password = $pass1;
		$user->changePassword($password, $id);
		header('Location: user_view.php');
	}
	else
	{
		$output = <<<EOD
		<output style="color:red">Fälten är inte lika. Båda fälten måste vara lika.</output>
EOD;
	}
}

$conDB['title'] = "Byt Lösenord";

$conDB['main'] = <<<EOD

<p><a href="javascript:history.go(-1)" class="back"> &lt;&lt;&lt; Tillbaka</a></p>

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

}
else
{
	header('Location:index.php?error=true');
}
include(CONDB_THEME_PATH);