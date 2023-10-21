<?php

// Autoload global dependencies
require __DIR__ . '/../vendor/autoload.php';

// Boot up application
$app = require '../bootstrap/app.php';

$app->run();