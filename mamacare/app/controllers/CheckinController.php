<?php
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Checkin.php";

class CheckinController {
    private $usermodel;
    private $checkin;

    public function __construct($db) {
        $this->usermodel = new User($db);
        $this->checkin = new Checkin($db);
    }

    public function checkin() {
        if (!isset($_SESSION['user'])) {
            echo "Bạn cần đăng nhập trước khi check-in!";
            return;
        }

        $username = $_SESSION['user'];
        $today = date("Y-m-d");

        $user = $this->usermodel->findByUsername($username);

        if (!$user) {
            echo "User not found!";
            return;
        }

        if ($user['check_in'] === $today) {
            echo "Bạn đã điểm danh hôm nay rồi!";
            return;
        }

        if ($this->checkin->doCheckin($username, $today)) {
            $week = $this->usermodel->getcurrentweek($user['first_day']);
            $tip = $this->checkin->getTip($user['id'], $week);

            if ($tip) {
                $this->checkin->markTipUsed($user['id'], $tip['id']);
                echo "Điểm danh thành công! (Tuần $week)<br>";
                echo "Mẹo cho hôm nay:<br>";
                echo $tip['content'];
            } else {
                echo "Điểm danh thành công, nhưng không tìm thấy mẹo mới.";
            }
        } else {
            echo "Check-in thất bại!";
        }
    }
}
