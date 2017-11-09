<?php

// web/index.php
require_once __DIR__.'/vendor/autoload.php';

$app = new Silex\Application();

$app->get('/testpage/', function () {
   return "LOL";
});

$app->run();
