<?php
require_once "../../Classes/Users.php";

session_start();

// if we are manager
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'manager') {
    header("Location: login.php");
    exit();
}

$username = isset($_SESSION['user']['username']) ? htmlspecialchars($_SESSION['user']['username']) : null;

$list = new Users();
$users = $list->getUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <link rel="stylesheet" href="../../styles/manager_homepage.module.css">
</head>

<body>
    <h1>Welcome, Manager <?= $username ?>!</h1>

    <a href="create_user.inc.php">Create User</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td>
                            <a href="edit_user.inc.php?id=<?php echo $user['id']; ?>">Edit</a>
                            <form action="../controller/delete_user.cntrl.inc.php" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align: center;">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="view_requests.inc.php">View the requests</a>
    <a href="../logout.inc.php">Logout</a>
</body>

</html>