<?php
require_once '../src/Database.php';  // Підключення PDO (вже є)
require_once '../src/ProductDAO.php';  // Для Product
require_once '../src/UserDAO.php';     // Новий для Users
require_once '../src/OrderDAO.php';    // Новий для Order
require_once '../src/ReviewDAO.php';   // Новий для Review
require_once '../src/WishlistDAO.php'; // Новий для Wishlist


$daoMap = [
    'product' => 'ProductDAO',
    'user' => 'UserDAO',      // Новий
    'order' => 'OrderDAO',    // Новий
    'review' => 'ReviewDAO',  // Новий
    'wishlist' => 'WishlistDAO' // Новий
];


$entity = $_GET['entity'] ?? 'product';
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;

if (isset($daoMap[$entity])) {
    $dao = new $daoMap[$entity]();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($action == 'create') {
            $dao->create($_POST);
        } elseif ($action == 'update' && $id) {
            $dao->update($id, $_POST);
        }
        header("Location: /?entity=$entity");
        exit;
    } elseif ($action == 'delete' && $id) {
        $dao->delete($id);
        header("Location: /?entity=$entity");
        exit;
    }

    switch ($action) {
        case 'create':
        case 'update':
            $item = ($action == 'update' && $id) ? $dao->read($id) : [];
            include '../views/form.php'; // Адаптуй для сутності
            break;
        case 'view':
            if ($id) {
                $item = $dao->read($id);
                include '../views/view.php';
            }
            break;
        default:
            $items = $dao->readAll();
            include '../views/list.php';
    }
} else {
    echo "Невідома сутність";
}