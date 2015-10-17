<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{

$res = $user->getAllUsers();

$conDB['title'] = 'Användare';

$conDB['main'] = <<<EOD
<p><a href="user_add.php">Ny Användare</a></p>
<table>
	<form method=post>
		<tr>
			<td>Akronym</td>
			<td>Namn</td>
			<td>Telefon Nr</td>
			<td>E-Post</td>
		</tr>
EOD;

foreach($res as $val)
{
	if($val->acronym != 'admin')
	{
		$conDB['main'] .= <<<EOD
		<tr>
			<td>{$val->acronym}</td>
			<td>{$val->last_name}, {$val->first_name}</td>
			<td>{$val->telnr1}</td>
			<td>{$val->email}</td>
			<td><a href="user_remove.php?id={$val->id}"><img src="img/remove.png" style="width:20px" alt="Remove"/></a></td>
		</tr>
EOD;
	}
}

$conDB['main'] .= <<<EOD
	</form>
</table>
EOD;

}
else
{
	header('Location:index.php?error=true');
}
include(CONDB_THEME_PATH);