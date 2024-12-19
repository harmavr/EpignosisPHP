<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Properties</title>
    <link rel="stylesheet" href="../../styles/create_user.module.css">
</head>

<body>
    <h1>User Properties</h1>

    <form action="../controller/create_user.cntrl.inc.php" method="post">
        <label for="username">Name</label>
        <input type="text" name="username" id="username">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="employee_code">Employer's Code</label>
        <input type="number" name="employee_code" id="employee_code">

        <label for="pwd">Password</label>
        <input type="password" name="pwd" id="pwd">

        <button type="submit">Save</button>
    </form>

    <a href="manager_homepage.inc.php">Back</a>
</body>

</html>