<?php

require_once 'config/config.php';
require_once 'views/View.php';
require_once 'models/Database.php';

$view = new View("Accueil", "home");
$view->render("home");
