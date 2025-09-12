<?php
require_once __DIR__."/../models/User.php";
class MainController {
    private $db;
    private $user;
    public function __construct($db) {
        $this->db = $db;
        $this->user = new User($db);
    }
    public function index() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php");
            exit;
        }
        $username = $_SESSION['user'];
        $userdata = $this->user->findByUsername($username);
        $firstday = $userdata["first_day"] ?? NULL;
        $currentweek = $firstday ? $this->user->getcurrentweek($firstday) : null;
        include __DIR__ . "/../views/main.php";
    }
}
