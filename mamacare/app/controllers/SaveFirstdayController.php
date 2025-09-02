<?php
require_once __DIR__ . "/../models/savefirstday.php";

class SaveFirstdayController {
    private $firstday;

    public function __construct($db) {
        $this->firstday = new Firstday($db);
    }

    public function save() {
        if (!isset($_SESSION['user'])) {
            header("Location: login.html");
            exit;
        }

        $firstday = $_POST['firstday'] ?? null;
        if (!$firstday) {
            echo "Vui lòng nhập ngày thụ thai";
            return;
        }
        $inputDate = strtotime($firstday);
        $today = strtotime("today");
        $minDate = strtotime("-40 weeks");
        if ($inputDate < $minDate || $inputDate > $today) {
            echo "Ngày không hợp lệ. Vui lòng chọn lại.";
            return;
        }

        $username = $_SESSION['user'];
        $result = $this->firstday->savefirstday($username, $firstday);
        if ($result === "Chọn ngày thành công") {
            header("Location: index.php?action=main");
            exit;
        } else {
            echo $result;
        }
        echo $result;
    }
}
