<?php
include(__DIR__.'/config.php');

$id = $user->getUserId();
$name = isset($_POST['name']) ? $_POST['name'] : $user->getUserName();
$adress1 = isset($_POST['adress1']) ? $_POST['adress1'] : $user->getUserAdress1();
$adress2 = isset($_POST['adress2']) ? $_POST['adress2'] : $user->getUserAdress2();
$postnr = isset($_POST['postnr']) ? $_POST['postnr'] : $user->getUserPostnr();
$postadr = isset($_POST['postadr']) ? $_POST['postadr'] : $user->getUserPostadr();
$telnr1 = isset($_POST['telnr1']) ? $_POST['telnr1'] : $user->getUserTelnr1();
$telnr2 = isset($_POST['telnr2']) ? $_POST['telnr2'] : $user->getUserTelnr2();
$email = isset($_POST['email']) ? $_POST['email'] : $user->getUserEmail();
$institute = isset($_POST['institute']) ? $_POST['institute'] : $user->getUserInst();

$save = isset($_POST['save']) ? true : false;

if($save == true)
{
	$user->editUser($conDB['database'],$name,$adress1,$adress2,$postnr,$postadr,$telnr1,$telnr2,$email,$institute,$id);
}

$conDB['title'] = "Uppdatera Konto";

$conDB['main'] = <<<EOD

<a href="javascript:history.go(-1)"> &lt;&lt;&lt; Tillbaka</a>

<form method=post>
	<fieldset>
		<legend>{$conDB['title']}</legend>
		<input type='hidden' name='id' value='{$id}'/>
		<p><label>Namn:<br/><input type='text' name='name' value='{$name}'/></label></p>
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

include(CONDB_THEME_PATH);