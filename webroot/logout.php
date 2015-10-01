<?php 

include(__DIR__.'/config.php'); 

$user->Logout();

$conDB['title'] = "Logout";

$conDB['main'] = <<<EOD

EOD;

include(CONDB_THEME_PATH);