<?php 

namespace App\Model;

use App\Database\Database;


class Product {
    private $db;

    public function __construct() {
        $this->db = (new Database())->pdo;
    }

    public function all() {
        $stmt = $this->db->query("SELECT * FROM tb_products ORDER BY id DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO tb_products (name, description, price) VALUES (?, ?, ?)");
        return $stmt->execute([$data['name'], $data['description'], $data['price']]);
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM tb_products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE tb_products SET name = ?, description = ?, price = ? WHERE id = ? ");
        return $stmt->execute([$data['name'], $data['description'], $data['price'], $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM tb_products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}



?>