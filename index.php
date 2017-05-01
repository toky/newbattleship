<?php
//session_start();
// Require autloader
require_once("./vendor/autoload.php");

if (DEBUG) { //Check debug mode
    // Set display erros
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// Create new instance of app
$application = new App\Utilities\Bootstrap();

// Run app
try {
    // Run game
    $application->run();
} catch (\App\Utilities\Exceptions $e) {
    echo "Application error:" . $e->getMessage();
}
// Method for restart game
//$application->restart();
