<?php
session_start();
require_once __DIR__ . "/../app/controllers/AuthController.php";
require_once __DIR__ . "/../app/controllers/MainController.php";
require_once __DIR__ . "/../app/controllers/CheckinController.php";
require_once __DIR__ . "/../app/controllers/SaveFirstdayController.php";

$dsn = "mysql:host=localhost;dbname=mamacare;charset=utf8";
$db = new PDO($dsn, "root", "");

$action = $_GET['action'] ?? null;

switch ($action) {
    case "login":
        (new AuthController($db))->login();
        break;
    case "register":
        (new AuthController($db))->register();
        break;
    case "logout":
        (new AuthController($db))->logout();
        break;
    case "main":
        (new MainController($db))->index();
        break;
    case "savefirstday":
        (new SaveFirstdayController($db))->save();
        break;
    case "checkin":
        (new CheckinController($db))->checkin();
        break;
    default:
        include __DIR__ . "/../app/views/login.html";
        break;
}
