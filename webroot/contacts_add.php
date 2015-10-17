<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{
$id = isset($_GET['id']) ? $_GET['id'] : null;
$coLIST = $contact->getAllCompanies();

$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null;
if($id == null)
{
	$coLIST = $contact->getAllCompanies();
	$company = isset($_POST['company']) ? $_POST['company'] : null;
}
else
{
	$co = $contact->getCompanyNameFromId($id);
	$company = $id;
}
$pos = isset($_POST['pos']) ? $_POST['pos'] : null;
$adress1 = isset($_POST['adress1']) ? $_POST['adress1'] : null;
$adress2 = isset($_POST['adress2']) ? $_POST['adress2'] : null;
$postnr = isset($_POST['postnr']) ? $_POST['postnr'] : null;
$postadr = isset($_POST['postadr']) ? $_POST['postadr'] : null;
$telnr = isset($_POST['telnr']) ? $_POST['telnr'] : null;
$dirnr = isset($_POST['dirnr']) ? $_POST['dirnr'] : null;
$mobilnr = isset($_POST['mobilnr']) ? $_POST['mobilnr'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$add = $user->getUser()->acronym;
$save = isset($_POST['save']) ? true : false;

if($save == true)
{
	$contact->add($last_name,$first_name,$company,$pos,$adress1,$adress2,$postnr,$postadr,$telnr,$dirnr,$mobilnr,$email,$add);
	if($id == null)
	{
		header('Location:contacts_all.php');
	}
	else
	{
		header('Location:contacts.php?id='.$id);
	}
}

$conDB['title'] = "Ny Kontakt";

$conDB['main'] = <<<EOD
<p><a href="javascript:history.go(-1)" class="back"> &lt;&lt;&lt; Tillbaka</a></p>
<form method=post>
	<fieldset>
		<legend>{$conDB['title']}</legend>
		<table id='empty'>
			<tr><td>Förnamn: </td><td><input id='text' type='text' name='first_name' value='{$first_name}' placeholder='Förnamn'/></td></tr>
			<tr><td>Efternamn: </td><td><input id='text' type='text' name='last_name' value='{$last_name}' placeholder='Efternamn'/></td></tr>
EOD;
if($id == null)
{
$conDB['main'] .= <<<EOD
			<tr><td>Företag: </td><td><select name='company'>
EOD;
	foreach($coLIST as $val)
	{
		$conDB['main'] .= <<<EOD
		<option value='{$val->id}'>{$val->cname}</option>
EOD;
	}
	$conDB['main'] .= <<<EOD
	</select></td>
EOD;
}
else
{
$conDB['main'] .= <<<EOD
			<tr><td>Företag: </td><td><input id='text' type='text' name='company' value='{$co->cname}' disabled='disabled'/></td></tr>
EOD;
}
$conDB['main'] .= <<<EOD
			<tr><td>Position: </td><td><input id='text' type='text' name='pos' value='{$pos}' placeholder='Position'/></td></tr>
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