<?php 
/**
 * This is a Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 
 
 
// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "404";
$alpha['header'] = "";
$alpha['main'] = "404 Page not found";
$alpha['footer'] = "";
 
// Send the 404 header 
header("HTTP/1.0 404 Not Found");
 
 
// Finally, leave it all to the rendering phase of Alpha.
include(CONDB_THEME_PATH);