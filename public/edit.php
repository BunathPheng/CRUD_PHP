<?php
include_once '../config/database.php';
include_once '../classes/User.php';
include_once '../includes/header.php';

// Debugging: Add error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$database = new Database();
$db = $database->getConnection();

// User object
$user = new User($db);

// Check if ID is set
$message = "";
$messageType = "";

// Debugging: Check if ID is received
if (!isset($_GET['id'])) {
    die("No user ID provided");
}

// Fetch user data for editing
$user->id = $_GET['id'];
$result = $user->readOne();

// Debugging: Check result
if (!$result) {
    die("Failed to fetch user data");
}

$row = $result->fetch_assoc();

// Process form submission
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user->id = $_POST['id'];
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->phone = $_POST['phone'];

    if($user->update()) {
        $message = "User updated successfully.";
        $messageType = "success";
        header("Location: index.php");
        exit();
    } else {
        $message = "Unable to update user.";
        $messageType = "danger";
    }
}
?>

<div class="container">
    <?php if(!empty($message)): ?>
        <div class="alert alert-<?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $user->id; ?>">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" 
                   value="<?php echo htmlspecialchars($row['name']); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" 
                   value="<?php echo htmlspecialchars($row['email']); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" 
                   value="<?php echo htmlspecialchars($row['phone']); ?>" required>
        </div>
        
        <button type="submit" class="btn btn-success">Update User</button>
        <a href="index.php" class="btn">Cancel</a>
    </form>
</div>

<?php include_once '../includes/footer.php'; ?>