<?php

require_once 'config/config.php';
require_once 'views/View.php';

$view = new View("Home");
$view->render("home");
