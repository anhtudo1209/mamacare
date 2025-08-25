<?php
require_once __DIR__ . "/../models/savebirthday.php";

class BirthdayController {
    private $birthday;

    public function __construct($db) {
        $this->birthday = new Birthday($db);
    }

    public function save() {
        if (!isset($_SESSION['user'])) {
            header("Location: login.html");
            exit;
        }

        $birthday = $_POST['birthday'] ?? null;
        if (!$birthday) {
            echo "Vui lòng nhập ngày sinh";
            return;
        }
        $username = $_SESSION['user'];
        $result = $this->birthday->saveBirthday($username, $birthday);
        if ($result === "Chọn ngày thành công") {
            header("Location: index.php?action=main");
            exit;
        } else {
            echo $result;
        }
        echo $result;
    }
}
