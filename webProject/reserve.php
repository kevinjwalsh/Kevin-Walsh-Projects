<?php
require_once "includes/dbh.inc.php";
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<title>Make Reservation</title>

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

<h1>Make a Reservation!</h1>

<form id="reserve" action="includes/reserve.inc.php" method="POST">
	<label>Name For Reservation</label>
	<input name="name" required></input>
	<br></br>
	<label>Pick a Date:</label>
	<input type="date" name="date" required></input>
	<br></br>
	<label>Pick a Time:</label>
	<input type="time" min="08:00" max="01:00" name="time" required></input>
	<br></br>
	<label>How Many Guests?:</label>
		<select name="guests" required>
		    <option>1</option>
		    <option>2</option>
		    <option>3</option>
		    <option>4</option>
		    <option>5</option>
		    <option>6</option>
		    <option>7</option>
		    <option>8</option>
		    <option>9</option>
		    <option>10</option>
  		</select>
  <br></br>
	<button class="button-73" role="button" type="submit">Confirm Reservation</button>
</form>

<br></br>

<form id="reserve" action="reservationList.php">
	<label>Need to cancel a reservation?</label>
	<button class="button-73" role="button" type="submit">Check Reservations</button>
</form>

<br></br>
<label>© 2021 WEB PROGRAMMING INTERNATIONAL ALL RIGHTS RESERVED</label>
</html>
