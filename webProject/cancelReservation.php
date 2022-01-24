<?php
require_once "includes/dbh.inc.php";
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<title>Cancel Reservation</title>

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

<h1>Cancel a Reservation</h1>
    <form action="includes/cancelR.inc.php" method="POST">
        <label>Are you sure you want to cancel your reservation? Enter Reservation ID to confirm</label>
        <input type="text" name="id" placeholder="ID">
        <br>
        <button class="button-24" role="button"type="submit" name="submit">Cancel Reservation</button>
    </form>
    <br></br>
    <form action="reservationList.php">
        <button class="button-73" role="button" type="submit">Reservations</button>
    </form>
</main>
</body>

<br></br>
<label>© 2021 WEB PROGRAMMING INTERNATIONAL ALL RIGHTS RESERVED</label>
</html>