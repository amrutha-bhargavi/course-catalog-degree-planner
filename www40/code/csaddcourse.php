<!DOCTYPE html>
<html>

<head>
    <title>CS courses table</title>
    <style type="text/css">
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Style the header */
        header {
            background-color: rgb(232, 117, 0);
            padding: 30px;
            text-align: center;
            font-size: 35px;
            color: white;
        }

        /* Create two columns/boxes that floats next to each other */
        nav {
            float: left;
            width: 20%;
            height: 15000px;
            /* only for demonstration, should be removed */
            background: #ccc;
            padding: 20px;
        }

        /* Style the list inside the menu */
        nav ul {
            list-style-type: none;
            padding: 0;
        }

        article {
            float: left;
            padding: 20px;
            width: 80%;
            background-color: #f1f1f1;
        }

        /* Clear floats after the columns */
        section:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Style the footer */
        footer {
            background-color: #777;
            padding: 10px;
            text-align: center;
            color: white;
        }

        /* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
        @media (max-width: 600px) {

            nav,
            article {
                width: 100%;
                height: auto;
            }
        }

        /* Style the search box */
        #mySearch {
            width: 100%;
            font-size: 18px;
            padding: 11px;
            border: 1px solid #ddd;
        }

        /* Style the navigation menu */
        #myMenu {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        /* Style the navigation links */
        #myMenu li a {
            padding: 12px;
            text-decoration: none;
            color: black;
            display: block
        }

        #myMenu li a:hover {
            background-color: #eee;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            color: #154734;
            font-family: monospace;
            font-size: 15px;
            text-align: center;
        }

        th {
            background-color: #154734;
            ;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <header>
        <img style="float:left;width:150px" src="logo.jpg" alt="UTD">
        <h5>2020 Available Courses for the Summer</h5>
        <h6><a style="color:white;float:right" href="index.php">HOME</a></h6>
    </header><br><br>
</body>


</html>


<?php // course2.php

require_once 'login.php';
$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);

if ($connection->connect_error) die($connection->connect_error);

if (isset($_POST['delete']) && isset($_POST['course_id'])) {
    $course_id   = get_post($connection, 'course_id');
    $query  = "DELETE FROM courses WHERE course_id='$course_id'";
    $result = $connection->query($query);

    // $query1  = "DELETE FROM prerequisites WHERE course_id='$course_id'";
    // $result1 = $connection->query($query);

    if (!$result) echo "DELETE failed: $query<br>" .
        $connection->error . "<br><br>";

    // if (!$result1) echo "DELETE prerequisite failed: $query<br>" .
    //     $connection->error . "<br><br>";
}


if (
    isset($_POST['edit']) && isset($_POST['course_id'])    &&
    isset($_POST['course_address']) &&
    isset($_POST['course_prefix'])    &&
    isset($_POST['course_title'])     &&
    isset($_POST['course_hours']) &&
    isset($_POST['course_description'])
) {
    $course_id   = get_post($connection, 'course_id');
    $course_address = get_post($connection, 'course_address');
    $course_prefix    = get_post($connection, 'course_prefix');
    $course_title     = get_post($connection, 'course_title');
    $course_hours     = get_post($connection, 'course_hours');
    $course_description     = get_post($connection, 'course_description');
    //echo $course_id; 
    $query    = "UPDATE `courses` SET `course_address`='$course_address',`course_description`='$course_description', `course_prefix`='$course_prefix' WHERE `courses`.`course_id` = '$course_id'";
    $result   = $connection->query($query);
    if (!$result) echo "update failed: $query<br>" .
        $connection->error . "<br><br>";
}



if (   
    isset($_POST['submit']) &&
    isset($_POST['course_id'])   &&
    isset($_POST['course_prefix'])    &&
    isset($_POST['course_address']) &&
    isset($_POST['course_title'])     &&
    isset($_POST['course_hours']) &&
    isset($_POST['course_description'])
) {
    $course_id   = get_post($connection, 'course_id');
    $course_prefix    = get_post($connection, 'course_prefix');
    $course_address = get_post($connection, 'course_address');
    $course_title     = get_post($connection, 'course_title');
    $course_hours     = get_post($connection, 'course_hours');
    $course_description    = get_post($connection, 'course_description');

    $query    = "INSERT INTO courses VALUES" .
        "('$course_id', '$course_prefix', '$course_address', '$course_title', '$course_hours', '$course_description')";
    $result   = $connection->query($query);

    if (!$result) echo "INSERT failed: $query<br>" .
        $connection->error . "<br><br>";
}

echo <<<_END
  <form action="course2.php" method="post"><pre>
    Course ID                   <input type="text" name="course_id">
    Course Prefix               <input type="text" name="course_prefix">
    Course Address              <input type="text" name="course_address">
    Course Title                <input type="text" name="course_title">
    Course Hours                <input type="text" name="course_hours">
    Course Description          <input type="text" name="course_description">
                                <input type="submit" name="submit" value="ADD RECORD">   <input type="submit" name="edit"  value="UPDATE"/>
  </pre></form>
_END;

$query  = "SELECT * FROM courses";
$result = $connection->query($query);

//$query1 = "SELECT * from "

if (!$result) die("Database access failed: " . $connection->error);

$rows = $result->num_rows;

for ($j = 0; $j < $rows; ++$j) {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);

    echo <<<_END
  <pre>
    Course Id:          $row[0]
    Course prefix:      $row[1]
    Course Address:     $row[2]
    Course Title:       $row[3]
    Course Hours:       $row[4]
    Course Description:$row[5]

  </pre>
  <form action="csaddcourse.php" method="post">
  <input type="hidden" name="delete" value="yes">
  <input type="hidden" name="course_id" value="$row[0]"> 
                          <input type="submit" value="DELETE RECORD"></form>
_END;
}

$result->close();
$connection->close();

function get_post($connection, $var)
{
    return $connection->real_escape_string($_POST[$var]);
}
