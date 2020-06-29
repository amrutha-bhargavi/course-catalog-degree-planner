<?php include('server.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <div class="container"></div>
    <div class="header">
        <h2>Registration</h2>
    </div>
    <form method="post" action="usersignup.php">
        <!-- diaplay validation errors here -->
        <?php include('errors.php') ?>
        <div class="input-group">
            <label>Username: </label>
            <input type="text" name="username" value="<?php echo $username;?>">
        </div>
        <div class="input-group">
            <label>email: </label>
            <input type="email" name="email" value="<?php echo $email;?>">
        </div>
        <div class="input-group">
            <label>Password: </label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label>Confirm Password: </label>
            <input type="password" name="password_2">
        </div>

        <div class="input-group">
            <button type="submit" name="register" class="btn">Register</button>
        </div>

        <p>Already a user? <a href="userlogin.php">Sign In</a></p>
    </form>


</body>

</html>