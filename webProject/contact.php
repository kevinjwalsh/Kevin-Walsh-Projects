<?php
require_once "includes/dbh.inc.php";
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<title>Contact Us</title>

<header>
    <a href="./index.php" class="logo">
        <h2>Quick Bytes</h2>
    </a>
    <nav>
        <?php

        // displays name of logged in user
        if (isset($_COOKIE["cookie"]) && $_COOKIE["cookie"] != "") {
            $sql = "SELECT name FROM users WHERE name = '" . $_COOKIE["cookie"] . "'";

            if ($result = $conn->query($sql)) {
                $name = $result->fetch_object()->name;
                echo '<p text-align="center">Welcome,  ' . $name . '!</p>';
                echo '<a href="logout.php">Logout</a>';
            }

        // if user is not logged in, make reservation becomes unavailable
        } else {
            echo '<a href="login.php">Login</a>';
        }
        ?>
    </nav>
</header>

<h1>Contact Us</h1>

<body>
<p id="contact">Call us at (443)-949-5382</p>
<p id="contact">Or shoot us an email at quickBytesOfficial.gov</p>
</body>


<img src="images/quickChef.png" alt="welp">

<br></br>
<label>© 2021 WEB PROGRAMMING INTERNATIONAL ALL RIGHTS RESERVED</label>
</html>