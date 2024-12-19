<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacation Request</title>
    <link rel="stylesheet" href="../../styles/request_vacation.module.css">
</head>

<body>
    <h1>Vacation Request</h1>

    <form action="../controller/request_vacation.cntrl.inc.php" method="post">
        <label for="date_from">Date From</label>
        <input type="date" name="date_from" required>

        <label for="date_to">Date To</label>
        <input type="date" name="date_to" required>

        <label for="reason">Reason</label>
        <textarea name="reason" required></textarea>

        <button type="submit">Submit</button>
    </form>

    <a href="employee_homepage.inc.php">Back</a>
</body>

</html>