<?php
class User {
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username=?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username, $password]);
        return $stmt->fetch();
    }
    public function register($username, $password) { 
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            return "username exist";
        }

        $stmt = $this->db->prepare("INSERT INTO users (username,password) VALUES (?,?)");
        if ($stmt->execute([$username, $password])) {
            return "register success";
        }
        return $stmt->execute([$username, $password]);
    }
    public function getcurrentweek($birthday) {
        $today = date("Y-m-d");
        $birth = new DateTime($birthday);
        $todayObj = new DateTime($today);
        $interval = $birth->diff($todayObj);
        return 40 - floor($interval->days / 7);
    }
    
}