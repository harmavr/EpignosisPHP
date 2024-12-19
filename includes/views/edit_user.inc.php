<?php
require_once "../../Classes/Users.php";

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'manager') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $list = new Users();
    $user = $list->getUserById($userId);
} else {
    header("Location: manager_homepage.inc.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/edit_user.module.css">
    <title>Edit User</title>
</head>

<body>
    <h1>Edit User - <?php echo htmlspecialchars($user['username']); ?></h1>

    <form action="../controller/update_user.cntrl.inc.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">

        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="pwd">Password</label>
        <input type="password" name="pwd" required>

        <button type="submit">Update User</button>
    </form>

    <a href="manager_homepage.inc.php">Back</a>
</body>

</html>