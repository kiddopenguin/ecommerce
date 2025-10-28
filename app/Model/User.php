<?php 

namespace App\Model;

use PDO;

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=ecommerce', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM tb_users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $email, $password) {
        $stmt = $this->pdo->prepare("INSERT INTO tb_users (name, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([
            $name,
            $email,
            password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

}


?>