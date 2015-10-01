<?php 
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $conDB variable with its defaults.
include(__DIR__.'/config.php'); 


// Add style for csource
$conDB['stylesheets'][] = 'css/source.css';


// Create the object to display sourcecode
//$source = new CSource();
$source = new CSource(array('secure_dir' => '..', 'base_dir' => '..', 'add_ignore' => array('.htaccess')));


// Do it and store it all in variables in the Alpha container.
$conDB['title'] = "Visa källkod";

$conDB['main'] = "<h1>Visa källkod</h1>\n" . $source->View();

// Finally, leave it all to the rendering phase of Alpha.
include(CONDB_THEME_PATH);