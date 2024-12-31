<?php 

class User {
    private $password;
    private $username;

    private $conn;


    public function __construct($password, $username, $conn) {
        $this->username = $username;
        $this->password = $password;
        $this->conn = $conn;
    }

    public function login() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM User WHERE username = ? LIMIT 1");
            $stmt->execute([$this->username]);
            echo $this->username;
            
            if ($stmt->rowCount() > 0) {
                echo "User found";
                $user = $stmt->fetch();
                if (!password_verify($this->password, $user['password'])) {
                    return false;
                }
                session_start();
                $_SESSION['user_username'] = $this->username;
                $_SESSION['user_name'] = $user['fullname'];
                $_SESSION['user_role'] = $user['role_id'];
                return true;
            }
            
            return false;
        } catch (PDOException $e) {
            throw new Exception("Login failed: " . $e->getMessage());
        }
    }

    public function register($fullname, $role){
        try {
            $stmt = $this->conn->prepare("INSERT INTO User (username, password, fullname, role_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$this->username, password_hash($this->password, PASSWORD_DEFAULT), $fullname, $role]);
            
            return true;
        } catch (PDOException $e) {
            throw new Exception("Registration failed: " . $e->getMessage());
        }
    }

    public function isAdmin(){
        return $_SESSION['user_role'] == 1;
    }


}