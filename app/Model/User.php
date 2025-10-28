<?php

namespace App\Model;

use PDO;
use App\Database\Database;

class User
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->pdo;
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tb_users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $email, $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO tb_users (name, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([
            $name,
            $email,
            password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    public function all()
    {
        $stmt = $this->pdo->query("SELECT id, name, email, created_at FROM tb_users ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT id, name, email, created_at FROM tb_users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $email, $password = null)
    {
        if ($password) {
            $stmt = $this->pdo->prepare("UPDATE tb_users SET name = ?, email = ?, password = ? WHERE id = ?");
            return $stmt->execute([
                $name,
                $email,
                password_hash($password, PASSWORD_DEFAULT),
                $id
            ]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE tb_users SET name = ?, email = ? WHERE id = ?");
            return $stmt->execute([
                $name,
                $email,
                $id
            ]);
        }
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tb_users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function emailExists($email, $ignoreId = null)
    {
        $query = "SELECT COUNT(*) AS total FROM tb_users WHERE email = ?";
        $params = [$email];

        if ($ignoreId) {
            $query .= " AND id != ?";
            $params[] = $ignoreId;
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $count = 0;
        if ($result) {
            $count = (int) ($result['total'] ?? ($result[0] ?? 0));
        }

        return $count > 0;
    }
}
