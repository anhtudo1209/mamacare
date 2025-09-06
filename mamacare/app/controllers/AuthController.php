<?php
require_once __DIR__ ."/../models/User.php";
class AuthController {
    private $user;
    public function __construct($db)
    {
        $this->user  = new User($db);
    }
    public function login() {
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
    
        if (!$username || !$password) {
            echo "Please enter username and password";
            return;
        }
        if (!preg_match('/^[a-zA-Z0-9]{6,16}$/', $username)) {
            echo "Invalid username format";
            return;
        }
        if (!preg_match('/^[A-Za-z\d]{6,20}$/', $password)) {
            echo "Invalid password format";
            return;
        }
    
        $result = $this->user->findByUsername($username); 
        if ($result && password_verify($password, $result['password'])) {
            $_SESSION['user'] = $result["username"]; 
            echo "Login successful";
        } else {
            echo "Invalid username or password";
        }
    }    
    public function register() {
        $username =  $_POST["new_username"] ?? NULL;
        $password = $_POST["new_pass"] ?? NULl;
        $confirm = $_POST["confirm_pass"] ?? NULL;
        if (!$username || !$password || !$confirm) {
            echo "All fields must not empty";
            return;
        }
        if (!preg_match('/^[a-zA-Z0-9]{6,16}$/', $username)) {
            echo "Username must be 6-16 characters and contain only letters and numbers";
            return;
        }
        if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,20}$/', $password)) {
            echo "Password must be 6-20 characters, contain only letters and numbers, and include at least one letter and one number";
            return;
        }
        if ($password !== $confirm) {
            echo "Passwords do not match";
            return;
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $result = $this->user->register($username, $hashedPassword);
        if ($result === "register success") {
            $_SESSION['user'] = $username;  
            echo $result;
        }
    }
    public function logout() {
        session_unset();
        session_destroy();
        header("Location: index.php"); 
        exit();
    }
}