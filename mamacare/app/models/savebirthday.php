<?php
class Birthday {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    public function saveBirthday($username, $birthday) {
        $stmt = $this->db->prepare("UPDATE users SET birth_day=? WHERE username=?");
        if ($stmt->execute([$birthday, $username])) {
            return "Chọn ngày thành công";
        }
        return "Lỗi khi lưu ngày sinh";
    }
}
