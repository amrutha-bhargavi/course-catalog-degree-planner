<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>UTD Course Catalog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
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
    </style>
</head>

<body>

    <header>
        <img style="float:left;width:150px" src="logo.jpg" alt="UTD">
        <h2>2019 CS Graduate Catalog</h2>
        <h6><a style ="color:white;float:right" href="index.php">HOME</a></h6>
    </header>
    <section>
        <nav>

            <?php // mysqlitest.php
            require_once 'login.php';
            $connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
            if ($connection->connect_error) die($connection->connect_error);
            $query  = "SELECT * FROM courses";
            $result = $connection->query($query);
            $rows = $result->num_rows;
            echo '<button onclick="myFunction()">Add Course</button><br><br>';
            echo '<h3>COURSES</h3>';
            echo '<input type="text" id="mySearch" onkeyup="myCompleteFunction()" placeholder="Search.." title="Type in a category">';
            echo '<ul id="myMenu">';

            for ($j = 0; $j < $rows; ++$j) {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                echo '<li><a href="#' . $row['course_id'] . '"> '   . $row['course_id']   . '</a></li>';
            }
            echo '</ul>';
            echo '</nav>';

            for ($j = 0; $j < $rows; ++$j) {
                $result->data_seek($j);
                $row = $result->fetch_array(MYSQLI_ASSOC);
                echo '<article id=' . $row['course_id'] . '"> ';
                echo '<h1>' . $row['course_title'] . '</h3>';
                echo '<p>' . $row['course_description'] . '</p>';
                echo '</article>';
            }
            $result->close();
            $connection->close();
            ?>
    </section>

    <footer>
        <a href="https://www.utdallas.edu">
            <img src="https://www.utdallas.edu/websvcs/shared/svg/utd-monogram-white.svg" alt="UTD-monogram" style="width:30px">
        </a>
    </footer>

</body>

</html>

<script>
    function myFunction() {
        window.open("http://localhost/cs6314/assign2/course1/task3/mysqlitest.php"); //for add option redirecting to new page
    }

    function myCompleteFunction() { //fro autocomplete form
        // console.log('onkeyup');
        var input, filter, ul, li, a, i;
        input = document.getElementById("mySearch");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myMenu");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>