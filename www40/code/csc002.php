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
            border: 0.5px solid black;
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
    <table>
        <tr>
            <th>TERM</th>
            <th>CLASS SECTION</th>
            <th>CLASS TITLE</th>
            <th>INSTRUCTORS</th>
            <th>SCHEDULE</th>
        </tr>
        <?php
        require_once 'login.php';
        $connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
        if ($connection->connect_error) die($connection->connect_error);

        $sql = "SELECT `TERM`, `CLASS SECTION`, `CLASS TITLE`, `INSTRUCTORS`, `SCHEDULE` FROM `cscourse` ORDER BY `CLASS SECTION` DESC";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['TERM'] . "</td><td>" . $row['CLASS SECTION'] . "</td><td>" . $row['CLASS TITLE'] . "</td><td>" . $row['INSTRUCTORS'] . "</td><td>" . $row['SCHEDULE'] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 result";
        }

        $connection->close();
        ?>
    </table>
</body>

</html>

</html>