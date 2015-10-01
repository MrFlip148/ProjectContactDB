<?php 

ob_start();

include(__DIR__.'/config.php');

if(isset($_POST['acronym']) && isset($_POST['password']))
{
	var_dump($_POST);
	$user->Login($conDB['database'], $_POST['acronym'], $_POST['password']);
}

$output = $user->IsLoggedIn();

if($user->isAuthentic())
{
	$conDB['title'] = "{$user->getUserName()}";
	$text = <<<EOD
	<fieldset>
		<legend>{$user->getUserAcronym()}</legend>
		<dl>
			<p>
				<dt><b>Adress</b></dt>
					<dd>{$user->getUserAdress1()}</dd>
					<dd>{$user->getUserAdress2()}</dd>
					<dd>{$user->getUserPostnr()}</dd>
					<dd>{$user->getUserPostadr()}</dd>
			</p>
			<p>
				<dt><b>Telefon Nr</b></dt>
					<dd>{$user->getUserTelnr1()}</dd>
					<dd>{$user->getUserTelnr2()}</dd>
			</p>
			<p>
				<dt><b>E-Post</b></dt>
				<dd>{$user->getUserEmail()}</dd>
			</p>
			<p>
				<dt><b>Institution</b></dt>
					<dd>{$user->getUserInst()}</dd>
			</p>
		<p><a href="userEdit.php">Redigera</a></p>
		<p><a href="userChangePassword.php">Ändra Lösenord</a></p>
	</fieldset>
EOD;
}
else
{
	$conDB['title'] = "Logga In";
	$text = <<<EOD
	<form method=post>
		<fieldset>
			<p><label>Akronym:<br/><input type='text' name='acronym' value=''/></label></p>
			<p><label>Lösenord:<br/><input type='text' name='password' value=''/></label></p>
			<input type="submit" value="Submit"/>
		</fieldset>
	</form>

EOD;
};

$conDB['main'] = <<<EOD
<h1>{$conDB['title']}</h1>
	{$text}
EOD;

include(CONDB_THEME_PATH);