<?php 
include(__DIR__.'/config.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;
$output = null;

$type = isset($_POST['type']) ? $_POST['type'] : null;
$dateOfCase = isset($_POST['dateOfCase']) ? $_POST['dateOfCase'] : null;
$timeOfCase = isset($_POST['timeOfCase']) ? $_POST['timeOfCase'] : null;
if($id == null)
{
	$relContact = isset($_POST['relContact']) ? $_POST['relContact'] : null;
	$relCompany = isset($_POST['relCompany']) ? $_POST['relCompany'] : null;
}
else
{
	$res = $contact->getContactFromId($id);
	$relContact = isset($_POST['relContact']) ? $_POST['relContact'] : $res->name;
	$relCompany = isset($_POST['relCompany']) ? $_POST['relCompany'] : $res->company;
}
$createdBy = isset($_POST['createdBy']) ? $_POST['createdBy'] : $user->getUserAcronym();
$content = isset($_POST['content']) ? $_POST['content'] : null;

$save = isset($_POST['save']) ? true : false;

if($save == true)
{
	$timeOfCase = $timeOfCase . ':00';
	$data = $contact->getCompanyFromName($relContact);
	$relCompany = $data->company;
	$app->add($type,$dateOfCase,$timeOfCase,$relContact,$relCompany,$createdBy,$content);
	$output = $db->dump();
}

$conDB['title'] = 'Nytt Ärende';

$conDB['main'] = <<<EOD
<a href="javascript:history.go(-1)"> <<< Tillbaka</a>

<form method = post>
	<fieldset>
		<legend>{$conDB['title']}</legend>
		<output>{$output}</output>
		<input type='hidden' name='createdBy' value='{$createdBy}'/>
EOD;
if($id == null)
{
	$conDB['main'] .= <<<EOD
			<p><label>Kontakt:<br/><input list='relContact' name='relContact'>
				<datalist id='relContact'>
EOD;
	$nfo = $contact->getContacts();
	foreach($nfo as $val)
	{
		$conDB['main'] .= <<<EOD
					<option value='{$val->name}'>{$val->name} @ {$val->company}</option>
EOD;
	}
	$conDB['main'] .= <<<EOD
				</datalist></label></p>
EOD;
}
else
{
	$conDB['main'] .= <<<EOD
			<p><label>Kontakt: {$relContact}<input type='hidden' name='relContact' value='{$relContact}'/></label></p>
			<p><label>Företag: {$relCompany}<input type='hidden' name='relCompany' value='{$relCompany}'/></label></p>
EOD;
}
$conDB['main'] .= <<<EOD
		<p><label>Datum & Tid:<br/><input type='date' name='dateOfCase' value='{$dateOfCase}'/>
		<input type='time' name='timeOfCase' value='{$timeOfCase}'/></label></p>
		<p><label>Typ av Ärende:<br/>
			<input list='type' name='type'>
			<datalist id='type'>
				<option value='Extra Jobb'>
				<option value='Forskning'>
				<option value='Studiebesök'>
				<option value='Föreläsare'>
			</datalist></label></p>
		<p><label>Noteringar:<br/><textarea name='content' rows='20' cols='50'></textarea></label></p>
		<p><input type='submit' name='save' value='Spara'/> <input type='reset' value='Återställ'/></p>
	</fieldset>
</form>
EOD;
include(CONDB_THEME_PATH);