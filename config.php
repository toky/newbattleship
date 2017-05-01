<?php
//Define const for host, directory separator and home directory
define('HOST', '');
define('DS', '/');
define('HOME', dirname(__FILE__));

// Degine main grid dimensions GridRow and GridCol
define('GRID_ROW', 10);
define('GRID_COL', 10);

// Degine ships size
define('BATTLESHIP_LENGHT', 5);
define('DESTROYER_LENGHT', 4);
define('BATTLESHIP_COUNT', 1);
define('DESTROYERS_COUNT', 1);

// Set constant is cli
define('IS_CLIENT', php_sapi_name() == 'cli');

// Set constant for debug mode
define('DEBUG', true);
