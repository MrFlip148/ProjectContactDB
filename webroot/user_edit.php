<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{

$id 		= isset($_POST['id']) 			? $_POST['id'] 			: $user->getUser()->id;
$first_name = isset($_POST['first_name']) 	? $_POST['first_name'] 	: $user->getUser()->first_name;
$last_name 	= isset($_POST['last_name']) 	? $_POST['last_name'] 	: $user->getUser()->last_name;
$adress1 	= isset($_POST['adress1']) 		? $_POST['adress1'] 	: $user->getUser()->adress1;
$adress2 	= isset($_POST['adress2']) 		? $_POST['adress2'] 	: $user->getUser()->adress2;
$postnr 	= isset($_POST['postnr']) 		? $_POST['postnr'] 		: $user->getUser()->postnr;
$postadr 	= isset($_POST['postadr']) 		? $_POST['postadr'] 	: $user->getUser()->postadr;
$telnr1 	= isset($_POST['telnr1']) 		? $_POST['telnr1'] 		: $user->getUser()->telnr1;
$telnr2 	= isset($_POST['telnr2']) 		? $_POST['telnr2'] 		: $user->getUser()->telnr2;
$email 		= isset($_POST['email']) 		? $_POST['email'] 		: $user->getUser()->email;
$institute 	= isset($_POST['institute']) 	? $_POST['institute'] 	: $user->getUser()->Institution;
$save 		= isset($_POST['save']) 		? true 					: false;

if($save == true)
{
	$user->edit($first_name,$last_name,$adress1,$adress2,$postnr,$postadr,$telnr1,$telnr2,$email,$institute,$id);
	header('Location: user_list.php');
}

$conDB['title'] = "Redigera Konto";

$conDB['main'] = <<<EOD

<p><a href="javascript:history.go(-1)" class="back"> &lt;&lt;&lt; Tillbaka</a></p>

<form method=post>
	<fieldset>
		<legend>{$conDB['title']}</legend>
		<input type='hidden' name='id' value='{$id}'/>
		<p><label>Förnamn:<br/><input type='text' name='first_name' value='{$first_name}'/></label></p>
		<p><label>Efternamn:<br/><input type='text' name='last_name' value='{$last_name}'/></label></p>
		<p><label>Adress:<br/><input type='text' name='adress1' value='{$adress1}'/></label></p>
		<p><input type='text' name='adress2' value='{$adress2}'/></label></p>
		<p><label>PostNr:<br/><input type='text' name='postnr' value='{$postnr}'/></label></p>
		<p><label>Post Adress:<br/><input type='text' name='postadr' value='{$postadr}'/></label></p>
		<p><label>Tel.Nr.:<br/><input type='text' name='telnr1' value='{$telnr1}'/></label></p>
		<p><label>Mobil Nr.<br/><input type='text' name='telnr2' value='{$telnr2}'/></label></p>
		<p><label>E-Post:<br/><input type='text' name='email' value='{$email}'/></label></p>
		<p><label>Institution:<br/><input type='text' name='institute' value='{$institute}'/></label></p>
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