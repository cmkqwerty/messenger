<?php

ini_set('memory_limit', '-1');

// Autoload global dependencies
require_once __DIR__ . '/../vendor/autoload.php';

// Boot up application
$app = require_once '../bootstrap/app.php';

$app->run();