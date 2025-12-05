<h1>Список <?php echo $entity; ?></h1>
<table border="1">
    <tr><th>ID</th><th>Name</th><th>Actions</th></tr>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['product_id']; ?></td>
        <td><?php echo $item['name']; ?></td>
        <td>
            <a href="?entity=<?php echo $entity; ?>&action=view&id=<?php echo $item['product_id']; ?>">View</a>
            <a href="?entity=<?php echo $entity; ?>&action=update&id=<?php echo $item['product_id']; ?>">Update</a>
            <a href="?entity=<?php echo $entity; ?>&action=delete&id=<?php echo $item['product_id']; ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="?entity=<?php echo $entity; ?>&action=create">Create new</a>