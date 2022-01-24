<?php
require_once "includes/dbh.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
<title>Home</title>

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

<img src="images/quickChef.png" alt="welp">

<br></br>

<label id="hours">Open Every Day 8AM-1AM!</label>

<br></br>

<?php

        // displays name of logged in user
        if (isset($_COOKIE["cookie"]) && $_COOKIE["cookie"] != "") {
            $sql = "SELECT name FROM users WHERE name = '" . $_COOKIE["cookie"] . "'";

            if ($result = $conn->query($sql)) {
                echo '<a href="menu.php"><button class="button-73" role="button" type="submit">Menu</button></a>';
                echo '<a href="reserve.php"><button class="button-73" role="button" type="submit">Make A Reservation</button></a>';
                echo '<a href="contact.php"><button class="button-73" role="button" type="submit">Contact Us</button></a>';
            }

        // if user is not logged in, make reservation becomes unavailable
        } else {
                echo '<a href="menu.php"><button class="button-73" role="button" type="submit">Menu</button></a>';
                echo '<a href="contact.php"><button class="button-73" role="button" type="submit">Contact Us</button></a>';
        }
        ?>

<br></br>
<label>© 2021 WEB PROGRAMMING INTERNATIONAL ALL RIGHTS RESERVED</label>


</html>
