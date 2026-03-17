<?php

require_once 'config/config.php';
require_once 'views/View.php';
require_once 'models/Database.php';

$db = Database::getInstance();
$pdo = $db->getPDO();
$stmt = $pdo->query('SELECT * FROM users');
$rows = $stmt->fetchAll();
var_dump($rows);

$view = new View("Accueil", "home");
$view->render("home");
