<?php
include_once '../config/database.php';
include_once '../classes/User.php';
include_once '../includes/header.php';

// Database connection
$database = new Database();
$db = $database->getConnection();

// User object
$user = new User($db);

// Get users
$result = $user->read();
?>

<div class="container">
    <a href="create.php" class="btn btn-success">Add New User</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td class="actions">
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include_once '../includes/footer.php'; ?>