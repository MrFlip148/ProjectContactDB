<?php 
include(__DIR__.'/config.php');

$id = $_GET['id'];

$res = $app->getAppointmentFromId($id);

$nfo = $contact->getContacts();

$type = isset($_POST['type']) ? $_POST['type'] : $res->type;
$dateOfCase = isset($_POST['dateOfCase']) ? $_POST['dateOfCase'] : $res->dateOfCase;
$timeOfCase = isset($_POST['timeOfCase']) ? $_POST['timeOfCase'] : $res->timeOfCase;
$relContact = isset($_POST['relContact']) ? $_POST['relContact'] : $res->relContact;
$relCompany = isset($_POST['relCompany']) ? $_POST['relCompany'] : $res->relCompany;
$createdBy = isset($_POST['createdBy']) ? $_POST['createdBy'] : $res->createdBy;
$content = isset($_POST['content']) ? $_POST['content'] : $res->content;

$save = isset($_POST['save']) ? true : false;

if($save == true)
{
	$timeOfCase = $timeOfCase . ':00';
	$data = $contact->getCompanyFromName($relContact);
	$relCompany = $data->company;
	$app->edit($type,$dateOfCase,$timeOfCase,$relContact,$relCompany,$createdBy,$content,$id);
}

$conDB['title'] = 'Redigera Ärende';

$conDB['main'] = <<<EOD
<a href="javascript:history.go(-1)"> <<< Tillbaka</a>

<form method = post>
	<fieldset>
		<legend>{$conDB['title']}</legend>
		<input type='hidden' name='createdBy' value='{$createdBy}'/>
		<p><label>Kontakt:<br/><input list='relContact' name='relContact' value='{$relContact}'>
			<datalist id='relContact'>
EOD;
foreach($nfo as $val)
{
	$conDB['main'] .= <<<EOD
				<option value='{$val->name}'>{$val->name} @ {$val->company}</option>
EOD;
}
$conDB['main'] .= <<<EOD
			</datalist></label></p>
		<p><label>Datum & Tid:<br/><input type='date' name='dateOfCase' value='{$dateOfCase}'/>
		<input type='time' name='timeOfCase' value='{$timeOfCase}'/></label></p>
		<p><label>Typ av Ärende:<br/>
			<input list='type' name='type' value='{$type}'>
			<datalist id='type'>
				<option value='Extra Jobb'>
				<option value='Forskning'>
				<option value='Studiebesök'>
				<option value='Föreläsare'>
			</datalist></label></p>
		<p><label>Noteringar:<br/><textarea name='content' rows='20' cols='50'>{$content}</textarea></label></p>
		<p><input type='submit' name='save' value='Spara'/> <input type='reset' value='Återställ'/></p>
	</fieldset>
</form>
EOD;

include(CONDB_THEME_PATH);