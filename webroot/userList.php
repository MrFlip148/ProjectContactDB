<?php
include(__DIR__.'/config.php');

$results = $user->getAllUsers($conDB['database']);

$conDB['title'] = 'Användar Lista';

$conDB['main'] = <<<EOD
<p><a href="userAdd.php">Ny Användare</a></p>
<table border=1>
	<form method=post>
		<tr>
			<td>Akronym</td>
			<td>Namn</td>
			<td>Telefon Nr</td>
			<td>E-Post</td>
		</tr>
EOD;

foreach($results as $val)
{
	if($val->acronym != 'admin')
	{
		$conDB['main'] .= <<<EOD
		<tr>
			<td>{$val->acronym}</td>
			<td>{$val->name}</td>
			<td>{$val->telnr1}</td>
			<td>{$val->email}</td>
			<td><a href="userRemove.php?id={$val->id}"><img src="img/remove.png" style="width:20px" alt="Remove"/></a></td>
		</tr>
EOD;
	}
}

$conDB['main'] .= <<<EOD
	</form>
</table>
EOD;

include(CONDB_THEME_PATH);