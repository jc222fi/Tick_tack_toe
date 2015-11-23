<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', "ON");

require_once("controller/Controller.php");

$controller = new \controller\Controller();

$controller->doGame();
$controller->getView();