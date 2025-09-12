<?php
class Firstday {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    public function savefirstday($username, $firstday) {
        $stmt = $this->db->prepare("UPDATE users SET first_day=? WHERE username=?");
        if ($stmt->execute([$firstday, $username])) {
            return "Chọn ngày thành công";
        }
        return "Lỗi khi lưu ngày thụ thai";
    }
}
