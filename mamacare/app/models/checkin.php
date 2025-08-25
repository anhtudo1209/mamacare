<?php
class Checkin {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function doCheckin($username, $today) {
        $stmt = $this->db->prepare("UPDATE users SET checkin_count = checkin_count+1, check_in=? WHERE username = ?");
        if ($stmt->execute([$today, $username])) {
            return "Check-in thành công";
        }
        return "Check-in thất bại";
    }
    
    public function getTip($userId, $week) {
        $sql = "SELECT t.id, t.content FROM tips t
                LEFT JOIN user_tips ut ON t.id = ut.tip_id AND ut.user_id = ?
                WHERE t.week = ? AND ut.tip_id IS NULL
                LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $week]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mark tip as used
    public function markTipUsed($userId, $tipId) {
        $stmt = $this->db->prepare("INSERT INTO user_tips (user_id, tip_id) VALUES (?, ?)");
        return $stmt->execute([$userId, $tipId]);
    }
}
