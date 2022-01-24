<?php
require_once "includes/dbh.inc.php";
?>

<?php
include_once 'includes/dbh.inc.php';

if (isset($_COOKIE["cookie"])) {
    $sql = "SELECT user_id FROM users WHERE name = '" . $_COOKIE["cookie"] . "'";

    if ($result = $conn->query($sql)) {
        $user_id = $result->fetch_object()->user_id;
    }
}

try {
$dsn = 'mysql:host=localhost;dbname=restaurant';
$username = 'root';
$password = '';
$db = new PDO($dsn,$username,$password);
} catch(PDOException $e) {
  $error_message = $e -> getMessage();
  echo "<p> An error occured while connecting to the database: $error_message </p>";
}

$queryProducts = 'SELECT * FROM reservations WHERE user_id = :user_id ORDER BY reservation_id';
$statement3 = $db -> prepare($queryProducts);
$statement3 -> bindValue(':user_id', $user_id);
$statement3 -> execute();
$reservations = $statement3 -> fetchAll();
$statement3 -> closeCursor();

?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<title>Reservations</title>

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

<h1>Reservations List</h1>

<table id="reservations">
    <tr>
    	<th id="menuHead">ID</th>
        <th id="menuHead">Name</th>
        <th id="menuHead">Date</th>
        <th id="menuHead">Time</th>
        <th id="menuHead">Guests</th>
    </tr>

    <?php foreach ($reservations as $reservation) : ?>
    <?php $test=1; ?>
    <tr>
    	<td id="menuItem"><?php echo $reservation['reservation_id']; ?></td>
        <td id="menuItem"><?php echo $reservation['name']; ?></td>
        <td id="menuItem"><?php echo $reservation['date']; ?></td>
        <td id="menuItem"><?php echo $reservation['time']; ?></td>
        <td id="menuItem"><?php echo $reservation['guests']; ?></td>
        <td><br><form action="cancelReservation.php"><button class="button-24" role="button">Delete</button></form></td>
    </tr>
    <?php $test++; ?>
    <?php endforeach; ?>
</table>

<br></br>
<label>© 2021 WEB PROGRAMMING INTERNATIONAL ALL RIGHTS RESERVED</label>

</html>