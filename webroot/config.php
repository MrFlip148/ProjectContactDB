<?php
/**
 * Config-file for Alpha. Change settings here to affect installation.
 *
 */
 
/**
 * Set the error reporting.
 *
 */
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors 
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly
 
 
/**
 * Define Alpha paths.
 *
 */
define('CONDB_INSTALL_PATH', __DIR__ . '/..');
define('CONDB_THEME_PATH', CONDB_INSTALL_PATH . '/theme/render.php');
 
 
/**
 * Include bootstrapping functions.
 *
 */
include(CONDB_INSTALL_PATH . '/src/bootstrap.php');
 
 
/**
 * Start the session.
 *
 */
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
session_start();
 
 
/**
 * Create the conDB variable.
 *
 */
$conDB = array();
 
/**
 * Settings for the database.
 *
 */

$conDB['database']['dsn']            = 'mysql:host=;dbname=';
$conDB['database']['username']       = '';
$conDB['database']['password']       = ''; 
$conDB['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"); 

$db = new CDatabase($conDB['database']);

 
/**
 * Site wide settings.
 *
 */
$conDB['lang']         = 'sv';
$conDB['title_append'] = ' | Kontakt Databas';

$conDB['header'] = <<<EOD
	<img class='sitelogo' src='img/logo.png' alt='ContactDB Logo' style='width:125px'/>
	<span class='sitetitle'>Kontact Databas</span>
	<span class='siteslogan'>En Databas med kontakter och ärenden</span>
EOD;

$conDB['footer'] = <<<EOD
<footer>
	<span class='sitefooter'>
	</span>
</footer>
EOD;

/**
 * Create user handler
 */
$user = new CUser($db);

/**
 * Create Contact handler
 */
$contact = new CContact($db);

/**
 * Create Contact handler
 */
$errand = new CErrand($db);

/**
 * Theme related settings.
 *
 */
$conDB['stylesheets'] = array('css/style.css');
$conDB['favicon']    = 'favicon.png';

/**
 * The navbar
 *
 */
$conDB['navbar'] = array('class' => 'nb-plain', 'items' => array(), 'callback_selected' => function($url)
{ if(basename($_SERVER['SCRIPT_FILENAME']) == $url) { return true; } } );

if($user->isAuthentic())
{
	$conDB['navbar']['items']['hem'] = array('text' => 'Hem','url' => 'index.php','title' => '');
	$conDB['navbar']['items']['contacts'] = array('text' => 'Alla Kontakter','url' => 'contacts_all.php','title' => '');
	$conDB['navbar']['items']['errands'] = array('text' => 'Alla Ärenden','url' => 'errands_all.php','title' => '');
	if($user->getUser()->acronym == 'admin')
	{
		$conDB['navbar']['items']['user_list'] = array('text' => 'Användare', 'url' => 'user_list.php', 'title' => 'Användare');
	}
	$conDB['navbar']['items']['user'] = array('text' => 'Mitt Konto','url' => 'user_view.php','title' => '{$user->getUser()->first_name}');
	$conDB['navbar']['items']['logout'] = array('text' => 'Logout', 'url' => 'logout.php', 'title' => 'Logga Ut');
}

/**
 * Google analytics.
 *
 */
$conDB['google_analytics'] = 'UA-22093351-1'; // Set to null to disable google analytics

/**
 * Settings for JavaScript.
 *
 */
 $conDB['modernizr'] = 'js/modernizr.js';
 
 $conDB['jquery'] = '//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js';
 
 $conDB['javascript_include'] = array();
 //$conDB['javascript_include'] = array('js/main.js'); // To add extra javascript files