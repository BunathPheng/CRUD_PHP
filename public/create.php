<?php
include_once '../config/database.php';
include_once '../classes/User.php';
include_once '../includes/header.php';

// Database connection
$database = new Database();
$db = $database->getConnection();

// User object
$user = new User($db);

// Process form submission
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->phone = $_POST['phone'];

    $message = "";
    $messageType = "";

    if($user->create()) {
        $message = "User created successfully.";
        $messageType = "success";
        // Redirect to index page
        header("Location: index.php");
        exit();
    } else {
        $message = "Unable to create user.";
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

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-success">Create User</button>
        <a href="index.php" class="btn">Cancel</a>
    </form>
</div>

<?php include_once '../includes/footer.php'; ?>