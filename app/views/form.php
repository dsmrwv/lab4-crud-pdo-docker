<h1><?php echo ucfirst($action); ?> <?php echo $entity; ?></h1>
<form method="POST">
    <?php
    // Додай require для DAO, якщо потрібно (або в index.php)
    require_once '../src/UserDAO.php';
    require_once '../src/ProductDAO.php';

    $userDAO = new UserDAO();
    $productDAO = new ProductDAO();

    $users = $userDAO->readAll();
    $products = $productDAO->readAll();

    if ($entity == 'user') { ?>
        <label>Email: <input name="email" value="<?php echo $item['email'] ?? ''; ?>"></label><br>
        <label>Password Hash: <input name="password_hash" value="<?php echo $item['password_hash'] ?? ''; ?>"></label><br>
        <label>Role: <input name="role" value="<?php echo $item['role'] ?? ''; ?>"></label><br>
        <label>Created At: <input type="date" name="created_at" value="<?php echo $item['created_at'] ?? ''; ?>"></label><br>
    <?php } elseif ($entity == 'product') { ?>
        <label>Name: <input name="name" value="<?php echo $item['name'] ?? ''; ?>"></label><br>
        <label>Category: <input name="category" value="<?php echo $item['category'] ?? ''; ?>"></label><br>
        <label>Price: <input type="number" step="0.01" name="price" value="<?php echo $item['price'] ?? ''; ?>"></label><br>
        <label>Stock: <input type="number" name="stock" value="<?php echo $item['stock'] ?? ''; ?>"></label><br>
    <?php } elseif ($entity == 'order') { ?>
        <label>User ID: 
            <select name="user_id">
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['user_id']; ?>" <?php if (isset($item['user_id']) && $item['user_id'] == $user['user_id']) echo 'selected'; ?>>
                        <?php echo $user['user_id'] . ' - ' . $user['email']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <label>Product ID: 
            <select name="product_id">
                <?php foreach ($products as $product): ?>
                    <option value="<?php echo $product['product_id']; ?>" <?php if (isset($item['product_id']) && $item['product_id'] == $product['product_id']) echo 'selected'; ?>>
                        <?php echo $product['product_id'] . ' - ' . $product['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <label>Order Date: <input type="date" name="order_date" value="<?php echo $item['order_date'] ?? ''; ?>"></label><br>
        <label>Delivery Method: <input name="delivery_method" value="<?php echo $item['delivery_method'] ?? ''; ?>"></label><br>
    <?php } elseif ($entity == 'review') { ?>
        <label>User ID: 
            <select name="user_id">
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['user_id']; ?>" <?php if (isset($item['user_id']) && $item['user_id'] == $user['user_id']) echo 'selected'; ?>>
                        <?php echo $user['user_id'] . ' - ' . $user['email']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <label>Product ID: 
            <select name="product_id">
                <?php foreach ($products as $product): ?>
                    <option value="<?php echo $product['product_id']; ?>" <?php if (isset($item['product_id']) && $item['product_id'] == $product['product_id']) echo 'selected'; ?>>
                        <?php echo $product['product_id'] . ' - ' . $product['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <label>Rating: <input type="number" min="1" max="5" name="rating" value="<?php echo $item['rating'] ?? ''; ?>"></label><br>
        <label>Comment: <textarea name="comment"><?php echo $item['comment'] ?? ''; ?></textarea></label><br>
    <?php } elseif ($entity == 'wishlist') { ?>
        <label>User ID: 
            <select name="user_id">
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['user_id']; ?>" <?php if (isset($item['user_id']) && $item['user_id'] == $user['user_id']) echo 'selected'; ?>>
                        <?php echo $user['user_id'] . ' - ' . $user['email']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <label>Product ID: 
            <select name="product_id">
                <?php foreach ($products as $product): ?>
                    <option value="<?php echo $product['product_id']; ?>" <?php if (isset($item['product_id']) && $item['product_id'] == $product['product_id']) echo 'selected'; ?>>
                        <?php echo $product['product_id'] . ' - ' . $product['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <label>Added Date: <input type="date" name="added_date" value="<?php echo $item['added_date'] ?? ''; ?>"></label><br>
    <?php } ?>
    <button type="submit">Save</button>
</form>