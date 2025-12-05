<?php
require_once 'Database.php';

class OrderDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::get();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO `Order` (user_id, product_id, order_date, delivery_method) VALUES (:user_id, :product_id, :order_date, :delivery_method)");
        $stmt->execute($data);
    }

    public function readAll() {
        return $this->pdo->query("SELECT * FROM `Order`")->fetchAll();
    }

    public function read($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM `Order` WHERE order_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE `Order` SET user_id = :user_id, product_id = :product_id, order_date = :order_date, delivery_method = :delivery_method WHERE order_id = :id");
        $data['id'] = $id;
        $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM `Order` WHERE order_id = :id");
        $stmt->execute(['id' => $id]);
    }
}