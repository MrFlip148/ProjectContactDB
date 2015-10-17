<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{

$res = $contact->getAll();

$conDB['title'] = 'Kontakter';

$conDB['main'] = <<<EOD
<p><a href="contacts_add.php">Ny Kontakt</a></p>
<table>
	<tr>
		<th>Namn</th>
		<th>Företag</th>
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
		<td><a href='contacts_view.php?id={$val->cID}'>{$val->last_name}, {$val->first_name}</a></td>
		<td>{$val->cname}</td>
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
	header('Location:index.php');
}
include(CONDB_THEME_PATH);