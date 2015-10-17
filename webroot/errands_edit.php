<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{

$id = isset($_GET['id']) ? $_GET['id'] : null;
$e = $errand->getErrandFromSelfId($id);
$c = $contact->getInfoFromId($e->id_Contacts);
$co = $contact->getCompanyIdFromContactId($e->id_Contacts);
$coList = $contact->getAllFromCompanyId($co->coID);

$id_Contacts = null;
$type = isset($_POST['type']) ? $_POST['type'] : $e->type;
$date_errand = isset($_POST['date_errand']) ? $_POST['date_errand'] : null;
$time_errand = isset($_POST['time_errand']) ? $_POST['time_errand'] : null;
$contacts = isset($_POST['contact']) ? $_POST['contact'] : null;
$content = isset($_POST['content']) ? $_POST['content'] : null;

$save = isset($_POST['save']) ? true : false;

if($save == true)
{
	$time_errand = $time_errand . ':00';
	$id_Contacts = $contacts;
	
	$errand->edit($type,$date_errand,$time_errand,$id_Contacts,$content,$id);
	header('Location:errands_view.php?id='.$id);
}

$conDB['title'] = "Redigera Ärende";

$conDB['main'] = <<<EOD
<p><a href="javascript:history.go(-1)" class="back"> &lt;&lt;&lt; Tillbaka</a></p>
<form method=post>
	<fieldset>
		<legend>{$conDB['title']}</legend>
		<table id='empty'>
			<tr><td>Kontakt: </td>
				<td><select name='contact'>
						<option value='{$e->id_Contacts}'>--Ingen Förändring-- ({$c->last_name}, {$c->first_name})</option>
EOD;
foreach($coList as $val)
{
	$name = $val->last_name . ', ' . $val->first_name;
	$conDB['main'] .= <<<EOD
						<option value='{$val->id}' >{$name}</option>
EOD;
}
$conDB['main'] .= <<<EOD
					</select></td></tr>
			<tr><td></td><td></td></tr>
			<tr><td>Typ: </td><td><label><input type='radio' name='type' value='Extra Jobb'/>Extra Jobb</label></td><td>Lämna tom om ingen ändring önskas</td></tr>
			<tr><td></td><td><label><input type='radio' name='type' value='Forskning'/>Forskning</label></td></tr>
			<tr><td></td><td><label><input type='radio' name='type' value='Studiebesök'/>Studiebesök</label></td></tr>
			<tr><td></td><td><label><input type='radio' name='type' value='Föreläsare'/>Föreläsare</label></td></tr>
			<tr><td></td><td><label><input type='radio' name='type' value='Projekt'/>Projekt</label></td></tr>
			<tr><td></td><td><input type='radio' name='type' value='annat'/><input id='text' type='text' name='annat' placeholder='Annat'/></td></tr>
			<tr><td></td><td></td></tr>
			<tr><td>Datum & Tid: </td><td><input type='date' name='date_errand' value='{$e->date_errand}'/> <input type='time' name='time_errand' value='{$e->time_errand}'/></td></tr>
			<tr><td></td><td></td></tr>
			<tr><td>Noteringar: </td><td></td></tr>
			<tr><td></td><td><textarea name='content' rows='20' cols='50'>{$e->content}</textarea></td></tr>
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