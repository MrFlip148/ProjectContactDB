<?php 

include(__DIR__.'/config.php');

$id = $_GET['id'];

$res = $contact->getContactFromId($id);

$name	 = isset($_POST['name']) ? $_POST['name'] : $res->name;
$company = isset($_POST['company']) ? $_POST['company'] : $res->company;
$position = isset($_POST['position']) ? $_POST['position'] : $res->position;
$adress1 = isset($_POST['adress1']) ? $_POST['adress1'] : $res->adress1;
$adress2 = isset($_POST['adress2']) ? $_POST['adress2'] : $res->adress2;
$postnr	 = isset($_POST['postnr']) ? $_POST['postnr'] : $res->postnr;
$postadr = isset($_POST['postadr']) ? $_POST['postadr'] : $res->postadr;
$telnr1	 = isset($_POST['telnr1']) ? $_POST['telnr1'] : $res->telnr1;
$telnr2	 = isset($_POST['telnr2']) ? $_POST['telnr2'] : $res->telnr2;
$email	 = isset($_POST['email']) ? $_POST['email'] : $res->email;

$save = isset($_POST['save']) ? true : false;

if($save == true)
{
	$contact->edit($name,$company,$position,$adress1,$adress2,$postnr,$postadr,$telnr1,$telnr2,$email,$id);
}


$conDB['title'] = 'Redigera Kontakt';

$conDB['main'] = <<<EOD
<a href="javascript:history.go(-1)"> <<< Tillbaka</a>
<form method = post>
	<fieldset>
		<legend>{$conDB['title']}</legend>
		<p><label>Namn:<br/><input type='text' name='name' value='{$res->name}'></label></p>
		<p><label>Företag:<br/><input type='text' name='company' value='{$res->company}'></label></p>
		<p><label>Position:<br/><input type='text' name='position' value='{$res->position}'></label></p>
		<p><label>Adress:<br/><input type='text' name='adress1' value='{$res->adress1}'></label></p>
		<p><input type='text' name='adress2' value='{$res->adress2}'></p>
		<p><label>Post Nr.<br/><input type='text' name='postnr' value='{$res->postnr}'></label></p>
		<p><label>Post Adress<br/><input type='text' name='postadr' value='{$res->postadr}'></label></p>
		<p><label>Telefon Nr:<br/><input type='text' name='telnr1' value='{$res->telnr1}'></label></p>
		<p><input type='text' name='telnr2' value='{$res->telnr2}'></p>
		<p><label>E-Post:<br/><input type='text' name='email' value='{$res->email}'></label></p>
		<p><input type='submit' name='save' value='Spara'/> <input type='reset' value='Återställ'/></p>
	</fieldset>
</form>
EOD;

include(CONDB_THEME_PATH);