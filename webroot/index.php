<?php 

ob_start();

include(__DIR__.'/config.php');

$output = <<<EOD
<output style="color:red"> <- Fältet får ej vara tom</output>
EOD;
$output1 = null;
$output2 = null;

$res = $contact->getCompany();

if(isset($_POST['acronym']) && isset($_POST['password']))
{
	if($_POST['acronym'] == "")
	{
		$output1 = $output;
	}
	if($_POST['password'] == "")
	{
		$output2 = $output;
	}
	else
	{
		var_dump($_POST);
		$user->Login($_POST['acronym'], $_POST['password']);
		header('Location: index.php');
	}
}

if($user->isAuthentic())
{
	$conDB['title'] = "Hem";
	$conDB['main'] = <<<EOD
	<h1>Välkommen {$user->getUser()->first_name} {$user->getUser()->last_name}</h1>
	<ul class='list'>
EOD;
	foreach($res as $val)
	{
		$conDB['main'] .= <<<EOD
		<li class='list'><p><a href='index_route.php?id={$val->id}'>{$val->cname}</a></p></li>
EOD;
	}
	$conDB['main'] .= <<<EOD
	</ul>
EOD;
}
else
{
	$conDB['title'] = "Logga In";
	$conDB['main'] = <<<EOD
	<h1 class='title'>{$conDB['title']}</h1>
	<hr class='colorgraph'><br/>
	<form method=post class='signin'>
		<input type='text' class='acronym' id='input' name='acronym' value='' placeholder='Akronym' />
		<input type='text' class='password' id='input' name='password' value='' placeholder='Lösenord' />
		<br/>
		<input id='input' class='btn_login' type="submit" value="Submit" />
	</form>
EOD;
};

include(CONDB_THEME_PATH);