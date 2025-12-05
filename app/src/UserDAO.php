<?php
require_once 'Database.php';

class UserDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::get();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO Users (email, password_hash, role, created_at) VALUES (:email, :password_hash, :role, :created_at)");
        $stmt->execute($data);
    }

    public function readAll() {
        return $this->pdo->query("SELECT * FROM Users")->fetchAll();
    }

    public function read($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE user_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE Users SET email = :email, password_hash = :password_hash, role = :role, created_at = :created_at WHERE user_id = :id");
        $data['id'] = $id;
        $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM Users WHERE user_id = :id");
        $stmt->execute(['id' => $id]);
    }
}