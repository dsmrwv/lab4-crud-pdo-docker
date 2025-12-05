<?php
require_once 'Database.php';

class ProductDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::get();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO Product (name, category, price, stock) VALUES (:name, :category, :price, :stock)");
        $stmt->execute($data);
    }

    public function readAll() {
        return $this->pdo->query("SELECT * FROM Product")->fetchAll();
    }

    public function read($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Product WHERE product_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE Product SET name = :name, category = :category, price = :price, stock = :stock WHERE product_id = :id");
        $data['id'] = $id;
        $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM Product WHERE product_id = :id");
        $stmt->execute(['id' => $id]);
    }
}