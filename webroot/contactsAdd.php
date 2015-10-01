<?php 

include(__DIR__.'/config.php');

$name	 = isset($_POST['name']) ? $_POST['name'] : null;
$company = isset($_POST['company']) ? $_POST['company'] : null;
$position = isset($_POST['position']) ? $_POST['position'] : null;
$adress1 = isset($_POST['adress1']) ? $_POST['adress1'] : null;
$adress2 = isset($_POST['adress2']) ? $_POST['adress2'] : null;
$postnr	 = isset($_POST['postnr']) ? $_POST['postnr'] : null;
$postadr = isset($_POST['postadr']) ? $_POST['postadr'] : null;
$telnr1	 = isset($_POST['telnr1']) ? $_POST['telnr1'] : null;
$telnr2	 = isset($_POST['telnr2']) ? $_POST['telnr2'] : null;
$email	 = isset($_POST['email']) ? $_POST['email'] : null;

$save = isset($_POST['save']) ? true : false;

if($save == true)
{
	$contact->add($name,$company,$position,$adress1,$adress2,$postnr,$postadr,$telnr1,$telnr2,$email);
}


$conDB['title'] = 'Ny Kontakt';

$conDB['main'] = <<<EOD
<a href="javascript:history.go(-1)"> &lt;&lt;&lt; Tillbaka</a>
<form method = post>
	<fieldset>
		<legend>{$conDB['title']}</legend>
		<p><label>Namn:<br/><input type='text' name='name' value='{$name}'></label></p>
		<p><label>Företag:<br/><input type='text' name='company' value='{$company}'></label></p>
		<p><label>Position:<br/><input type='text' name='position' value='{$position}'></label></p>
		<p><label>Adress:<br/><input type='text' name='adress1' value='{$adress1}'></label></p>
		<p><input type='text' name='adress2' value='{$adress2}'></p>
		<p><label>Post Nr.<br/><input type='text' name='postnr' value='{$postnr}'></label></p>
		<p><label>Post Adress<br/><input type='text' name='postadr' value='{$postadr}'></label></p>
		<p><label>Telefon Nr:<br/><input type='text' name='telnr1' value='{$telnr1}'></label></p>
		<p><input type='text' name='telnr2' value='{$telnr2}'></p>
		<p><label>E-Post:<br/><input type='text' name='email' value='{$email}'></label></p>
		<p><input type='submit' name='save' value='Spara'/> <input type='reset' value='Återställ'/></p>
	</fieldset>
</form>
EOD;

include(CONDB_THEME_PATH);