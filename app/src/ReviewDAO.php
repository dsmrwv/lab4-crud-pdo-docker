<?php
require_once 'Database.php';

class ReviewDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::get();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO Review (user_id, product_id, rating, comment) VALUES (:user_id, :product_id, :rating, :comment)");
        $stmt->execute($data);
    }

    public function readAll() {
        return $this->pdo->query("SELECT * FROM Review")->fetchAll();
    }

    public function read($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Review WHERE review_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE Review SET user_id = :user_id, product_id = :product_id, rating = :rating, comment = :comment WHERE review_id = :id");
        $data['id'] = $id;
        $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM Review WHERE review_id = :id");
        $stmt->execute(['id' => $id]);
    }
}