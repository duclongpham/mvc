<?php

define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

require('../vendor/autoload.php');
require('../bootstrap.php');

$dispatch = new Mvc\Dispatcher();
$dispatch->dispatch();
