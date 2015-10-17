<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{

$id = $_GET['id'];

$res = $contact->getAllFromCompanyId($id);

$conDB['title'] = 'Kontakter';

$conDB['main'] = <<<EOD
<p><a href="javascript:history.go(-1)" class="back"> &lt;&lt;&lt; Tillbaka</a></p>
<p><a href="contacts_add.php?id={$id}">Ny Kontakt</a></p>
<table>
	<tr>
		<th>Namn</th>
		<th>Telefon Nr</th>
		<th>Direkt Nr</th>
		<th>Mobil Nr</th>
		<th>E-Post</th>
	</tr>
EOD;

foreach($res as $val)
{
	$conDB['main'] .= <<<EOD
	<tr>
		<td><a href='contacts_view.php?id={$val->id}'>{$val->last_name}, {$val->first_name}</a></td>
		<td>{$val->telnr}</td>
		<td>{$val->telnrDirect}</td>
		<td>{$val->mobilnr}</td> 
		<td>{$val->email}</td>
EOD;
}

$conDB['main'] .= <<<EOD
</table>
EOD;
}
else
{
	header('Location:index.php?error=true');
}
include(CONDB_THEME_PATH);