<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{
$id = $_GET['id'];

$res = $contact->getInfoFromId($id);
$co = $contact->getCompanyNameFromId($res->company);
$coLIST = $contact->getAllCompanies();

$last_name	 = isset($_POST['last_name']) ? $_POST['last_name'] : $res->last_name;
$first_name	 = isset($_POST['first_name']) ? $_POST['first_name'] : $res->first_name;
$company = isset($_POST['company']) ? $_POST['company'] : $res->company;
$position = isset($_POST['position']) ? $_POST['position'] : $res->position;
$adress1 = isset($_POST['adress1']) ? $_POST['adress1'] : $res->adress1;
$adress2 = isset($_POST['adress2']) ? $_POST['adress2'] : $res->adress2;
$postnr	 = isset($_POST['postnr']) ? $_POST['postnr'] : $res->postnr;
$postadr = isset($_POST['postadr']) ? $_POST['postadr'] : $res->postadr;
$telnr	 = isset($_POST['telnr']) ? $_POST['telnr'] : $res->telnr;
$dirnr	 = isset($_POST['dirnr']) ? $_POST['dirnr'] : $res->telnrDirect;
$mobilnr = isset($_POST['mobilnr']) ? $_POST['mobilnr'] : $res->mobilnr;
$email	 = isset($_POST['email']) ? $_POST['email'] : $res->email;
$save = isset($_POST['save']) ? true : false;

if($save == true)
{
	$contact->edit($last_name,$first_name,$company,$position,$adress1,$adress2,$postnr,$postadr,$telnr,$dirnr,$mobilnr,$email,$id);
	header('Location:contacts_view.php?id='.$id);
}


$conDB['title'] = 'Redigera Kontakt';

$conDB['main'] = <<<EOD
<p><a href="javascript:history.go(-1)" class="back"> &lt;&lt;&lt; Tillbaka</a></p>
<form method = post>
	<fieldset>
		<legend>{$conDB['title']}</legend>
		<table border = 0>
			<tr><td>Förnamn: </td><td><input id='text' type='text' name='first_name' value='{$first_name}' placeholder='Förnamn'/></td></tr>
			<tr><td>Efternamn: </td><td><input id='text' type='text' name='last_name' value='{$last_name}' placeholder='Efternamn'/></td></tr>
			<tr><td>Företag: </td><td><select name='company'>
				<option value={$res->company}>Nuvarande: {$co->cname}</option>
EOD;

foreach($coLIST AS $val)
{
$conDB['main'] .= <<<EOD
<option value='{$val->id}'>{$val->cname}</option>
EOD;
}
$conDB['main'] .= <<<EOD
</select></td>
EOD;
$conDB['main'] .= <<<EOD
			<tr><td>Position: </td><td><input id='text' type='text' name='pos' value='{$position}' placeholder='Position'/></td></tr>
			<tr><td>Adress: </td><td><input id='text' type='text' name='adress1' value='{$adress1}' placeholder='Adress Rad 1'/></td></tr>
			<tr><td></td><td><input id='text' type='text' name='adress2' value='{$adress2}' placeholder='Adress Rad 2'/></td></tr>
			<tr><td>Post Nr: </td><td><input id='text' type='text' name='postnr' value='{$postnr}' placeholder='Post Nr'/></td></tr>
			<tr><td>Post Adr: </td><td><input id='text' type='text' name='postadr' value='{$postadr}' placeholder='Postadress'/></td></tr>
			<tr><td>Telefon Nr: </td><td><input id='text' type='text' name='telnr' value='{$telnr}' placeholder='Telefon'/></td></tr>
			<tr><td>Direkt Nr: </td><td><input id='text' type='text' name='dirnr' value='{$dirnr}' placeholder='Direkt Telefon'/></td></tr>
			<tr><td>Mobil Nr: </td><td><input id='text' type='text' name='mobilnr' value='{$mobilnr}' placeholder='Mobil'/></td></tr>
			<tr><td>E-Post: </td><td><input id='text' type='text' name='email' value='{$email}' placeholder='E-Post'/></td></tr>
			<tr><td></td><td><input type='submit' name='save' value='Spara'/> <input type='reset' value='Återställ'/></td></tr>
		</table>
	</fieldset>
</form>
EOD;

}
else
{
	header('Location:index.php?error=true');
}
include(CONDB_THEME_PATH);