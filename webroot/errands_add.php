<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{
$id = isset($_GET['id']) ? $_GET['id'] : null;
$idcheck = substr($id,-2);
$id = chop($id,$idcheck);

$c = null;
$cList = null;
$id_Contacts = null;
$type = isset($_POST['type']) ? $_POST['type'] : null;
$date_errand = isset($_POST['date_errand']) ? $_POST['date_errand'] : '0000-00-00';
$time_errand = isset($_POST['time_errand']) ? $_POST['time_errand'] : '00:00';
$contacts = isset($_POST['contact']) ? $_POST['contact'] : null;
$content = isset($_POST['content']) ? $_POST['content'] : null;
$createdBy = $user->getUser()->acronym;
$save = isset($_POST['save']) ? true : false;

if($idcheck == '.5')
{
	//from company
	$cList = $contact->getAllFromCompanyId($id);
}
else
{
	//from contact
	$c = $contact->getInfoFromId($id);
	$id_Contacts = $id;
}

if($save == true)
{
	$time_errand = $time_errand . ':00';
	if($type == 'annat')
	{
		$type = isset($_POST['annat']) ? $_POST['annat'] : 'Something_Failed';
	}
	if($idcheck == '.5')
	{
		$id_Contacts = $contacts;
	}
	
	$errand->add($type,$date_errand,$time_errand,$id_Contacts,$createdBy,$content);
	if($idcheck == '.5')
	{
		header('Location:errands.php?id='.$id);
	}
	else
	{
		header('Location:contacts_view.php?id='.$id);
	}
}

$conDB['title'] = "Nytt Ärende";

$conDB['main'] = <<<EOD
<p><a href="javascript:history.go(-1)" class="back"> &lt;&lt;&lt; Tillbaka</a></p>
<form method=post>
	<fieldset>
		<legend>{$conDB['title']}</legend>
		<table id='empty'>
EOD;
if($idcheck == '.5')
{
	$conDB['main'] .= <<<EOD
			<tr><td>Kontakt: </td><td><select name='contact' >
EOD;
	foreach($cList as $val)
	{
		$name = $val->last_name . ', ' . $val->first_name;
		$conDB['main'] .= <<<EOD
				
				<option value='{$val->id}' >{$name}</option>
EOD;
	}
	$conDB['main'] .= <<<EOD
			</select></td></tr>
EOD;
}
else
{
	$conDB['main'] .= <<<EOD
			<tr><td>Kontakt: </td><td><input id='text' type='text' name='' value='{$c->last_name}, {$c->first_name}' disabled='disabled' /></td></tr>
EOD;
}
$conDB['main'] .= <<<EOD

			<tr><td></td><td></td></tr>
			<tr><td>Typ: </td><td><label><input type='radio' name='type' value='Extra Jobb'/>Extra Jobb</label></td></tr>
			<tr><td></td><td><label><input type='radio' name='type' value='Forskning'/>Forskning</label></td></tr>
			<tr><td></td><td><label><input type='radio' name='type' value='Studiebesök'/>Studiebesök</label></td></tr>
			<tr><td></td><td><label><input type='radio' name='type' value='Föreläsare'/>Föreläsare</label></td></tr>
			<tr><td></td><td><label><input type='radio' name='type' value='Projekt'/>Projekt</label></td></tr>
			<tr><td></td><td><input type='radio' name='type' value='annat'/><input id='text' type='text' name='annat' placeholder='Annat'/></td></tr>
			<tr><td></td><td></td></tr>
			<tr><td>Datum & Tid: </td><td><input type='date' name='date_errand' value='{$date_errand}'/> <input type='time' name='time_errand' value='{$time_errand}'/></td></tr>
			<tr><td></td><td></td></tr>
			<tr><td>Noteringar: </td><td></td></tr>
			<tr><td></td><td><textarea name='content' rows='20' cols='50'></textarea></td></tr>
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