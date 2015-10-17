<?php
include(__DIR__.'/config.php');
if($user->isAuthentic())
{

$user->Logout();
header('Location: index.php');

$conDB['title'] = "Logout";

$conDB['main'] = <<<EOD

EOD;

}
else
{
	header('Location:index.php?error=true');
}
include(CONDB_THEME_PATH);