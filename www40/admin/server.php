<?php 
    session_start();
    $username ="";
    $email = "";
    $errors = array();
    //connect to the database
    $db = mysqli_connect('localhost', 'min', 'min', 'min');

    //on register button click
    if (isset($_POST['register'])){
        $username = $db->real_escape_string($_POST['username']);
        $email = $db->real_escape_string($_POST['email']);
        $password_1 = $db->real_escape_string($_POST['password_1']);
        $password_2 = $db->real_escape_string($_POST['password_2']);

        //ensuring form fields are filled properly
        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($email)){
            array_push($errors, "Email is required");
        }
        if(empty($password_1)){
            array_push($errors, "Password is required");
        }

        if($password_1 != $password_2){
            array_push($errors, "The two passwords do not match !");
        }

        //if there are no errors, save user to database
        if(count($errors) == 0){
            $password = md5($password_1); //encrypting password
            $sql = "INSERT INTO user (username, email, password) values('$username','$email','$password')";
            mysqli_query($db, $sql);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        }
    }


    //login user from login page
    if(isset($_POST['login'])){
        $username = $db->real_escape_string($_POST['username']);
        $password = $db->real_escape_string($_POST['password']);        

        //ensuring form fields are filled properly
        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($password)){
            array_push($errors, "Password is required");
        }

        if(count($errors) == 0){
            $password = md5($password);
            $query = "SELECT * FROM user WHERE username =  '$username' AND password = '$password'";
            $result = mysqli_query($db, $query);
            $date = date("Y/m/d h:i:sa");
            $query = "INSERT INTO session (user id, login) values ('$username','$date')";
            mysqli_query($db, $query);
            if(mysqli_num_rows($result) == 1){
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";

                header('location: index.php');
            }else{
                array_push($errors, "The username/password is not correct !");
                header('location: userlogin.php');
            }
        }
    }

    //logout
    if(isset($_GET['logout'])){
        $username = $_SESSION['username'];
        $query = "UPDATE SESSION set logout='curdate()' where user id='$username'";
        mysqli_query($db, $sql);
        session_destroy();
        unset($_SESSION['username']);
        header('location: usersignup.php');
    }
