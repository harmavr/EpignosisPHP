<?php
require_once "../../Classes/Requests.php";

session_start();

// if we are employee
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'employee') {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user']['id'];

$list = new Requests();
$requests = $list->getRequests($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="../../styles/employee_homepage.module.css">
</head>

<body>
    <h1>Welcome, Employee <?php echo htmlspecialchars($_SESSION['user']['username']); ?>!</h1>

    <a href="request_vacation.inc.php">Request Vacation</a>

    <table>
        <thead>
            <tr>
                <th>Date submitted</th>
                <th>Dates requested</th>
                <th>Reason</th>
                <th>Total Days</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($requests)) : ?>
                <?php foreach ($requests as $request) : ?>
                    <?php
                    $dates_requested = $request['date_request'];
                    list($date_from, $date_to) = explode(" / ", $dates_requested);

                    $date_from_obj = new DateTime($date_from);
                    $date_to_obj = new DateTime($date_to);

                    $interval = $date_from_obj->diff($date_to_obj);
                    $total_days = $interval->days;
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($request['date_submitted']); ?></td>
                        <td><?= htmlspecialchars($request['date_request']); ?></td>
                        <td><?= htmlspecialchars($request['reason']); ?></td>
                        <td><?= $total_days; ?></td>
                        <td>
                            <?= htmlspecialchars($request['status']); ?>
                            <?php if ($request['status'] === 'pending') : ?>
                                <form action="../controller/delete_request.cntrl.inc.php" method="POST" style="display: inline;">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($request['id']) ?>">
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this request?')">Delete</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No Requests found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="../logout.inc.php">Logout</a>
</body>

</html>