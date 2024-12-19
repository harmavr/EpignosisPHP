<?php

require_once "../../Classes/Requests.php";
$list = new Requests();
$requests = $list->getAllRequests();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/view_requests.module.css">
</head>

<body>

    <h1>View all the Requests</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($requests)): ?>
                <?php foreach ($requests as $request): ?>
                    <tr>
                        <td><?= htmlspecialchars($request['username']) ?></td>
                        <td><?= htmlspecialchars($request['status']) ?></td>
                        <td>
                            <form action="../controller/approve_request.cntrl.inc.php" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($request['id']) ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to approve this request?')">Approve</button>
                            </form>
                            <form action="../controller/reject_request.cntrl.inc.php" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($request['id']) ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to reject this request?')">Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align: center;">No Requests found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="manager_homepage.inc.php">Back</a>
</body>

</html>