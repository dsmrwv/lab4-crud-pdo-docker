<?php
// app/src/Database.php — з автоматичним чеканням MySQL
class Database {
    private static $pdo = null;

    public static function get() {
        if (self::$pdo === null) {
            $maxAttempts = 15;
            $attempt = 0;

            while ($attempt < $maxAttempts) {
                try {
                    $dsn = "mysql:host=db;dbname=shop_db;charset=utf8mb4";
                    $options = [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ];
                    self::$pdo = new PDO($dsn, "app", "app", $options);
                    break; // Успішно підключились — виходимо
                } catch (Exception $e) {
                    $attempt++;
                    if ($attempt >= $maxAttempts) {
                        die("Не вдалося підключитися до бази даних: " . $e->getMessage());
                    }
                    sleep(2); // Чекаємо 2 секунди і пробуємо ще раз
                }
            }
        }
        return self::$pdo;
    }
}