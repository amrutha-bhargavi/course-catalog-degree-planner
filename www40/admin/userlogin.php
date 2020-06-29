<?php include('server.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>UTD Degree Planner</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <div class="container"></div>
    <div class="header">
        <h2>Login</h2>
    </div>
    <form method="post" action="userlogin.php">
        <!-- diaplay validation errors here -->
        <?php include('errors.php') ?>
        <div class="input-group">
            <label>Username: </label>
            <input type="text" name="username">
        </div>
        <div class="input-group">
            <label>Password: </label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" name="login" class="btn">Login</button>
        </div>

        <p>New User? <a href="usersignup.php">Register</a></p>
    </form>


</body>

</html>