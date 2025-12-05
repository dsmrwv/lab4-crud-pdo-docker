<?php
require_once 'Database.php';

class WishlistDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::get();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO Wishlist (user_id, product_id, added_date) VALUES (:user_id, :product_id, :added_date)");
        $stmt->execute($data);
    }

    public function readAll() {
        return $this->pdo->query("SELECT * FROM Wishlist")->fetchAll();
    }

    public function read($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Wishlist WHERE wishlist_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE Wishlist SET user_id = :user_id, product_id = :product_id, added_date = :added_date WHERE wishlist_id = :id");
        $data['id'] = $id;
        $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM Wishlist WHERE wishlist_id = :id");
        $stmt->execute(['id' => $id]);
    }
}