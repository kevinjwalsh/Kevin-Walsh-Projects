<?php
require_once "includes/dbh.inc.php";

try {
$dsn = 'mysql:host=localhost;dbname=restaurant';
$username = 'root';
$password = '';
$db = new PDO($dsn,$username,$password);
} catch(PDOException $e) {
  $error_message = $e -> getMessage();
  echo "<p> An error occured while connecting to the database: $error_message </p>";
}

$reserveID = filter_input(INPUT_GET, 'reserveID',FILTER_VALIDATE_INT);
if ($reserveID == NULL || $reserveID ==  FALSE) {
$reserveID = 1;
}//

$queryReserve = "SELECT * FROM reservations WHERE reservation_id = :reserveID";
$statement1 = $db ->prepare($queryReserve);
$statement1 -> bindValue(':reserveID', $reserveID);
$statement1 -> execute();
$reservation = $statement1 -> fetch();
$reservation_name = $reservation['name'];
$statement1 -> closeCursor();


$queryAllReserve = 'SELECT * FROM reservations ORDER BY reservation_id';
$statement2 = $db -> prepare($queryAllReserve);
$statement2 -> execute();
$reservations = $statement2 -> fetchAll();
$statement2 -> closeCursor();

?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<title>Cancel Reservation</title>

<header>
    <a href="./index.php" class="logo">
        <h1>our restaurant</h1>
    </a>
    <nav>
        <?php
        // displays name of logged in user
        if (isset($_COOKIE["cookie"]) && $_COOKIE["cookie"] != "") {
            $sql = "SELECT name FROM users WHERE name = '" . $_COOKIE["cookie"] . "'";

            if ($result = $conn->query($sql)) {
                $name = $result->fetch_object()->name;
                echo '<p>Welcome, ' . $name . '!</p>';
                echo '<a href="menu.php">Menu</a>';
                echo '<a href="reserve.php">Make a Reservation</a>';
                echo '<a href="contact.php">Contact Us</a>';
                echo '<a href="logout.php">Logout</a>';
            }

        // if user is not logged in, make reservation becomes unavailable
        } else {
            echo '<a href="menu.php">Menu</a>';
            echo '<a href="contact.php">Contact Us</a>';
            echo '<a href="login.php">Login</a>';
        }
        ?>
    </nav>
</header>

<h1>Cancel a Reservation</h1>

<table>
    <tr>
        <th id="menuHead">Name</th>
        <th id="menuHead">Date</th>
        <th id="menuHead">Time</th>
        <th id="menuHead">Guests</th>
    </tr>

    <?php foreach ($reservations as $reservation) : ?>
    <?php $test=1; ?>
    <tr>
        <td><?php echo $reservation['name']; ?></td>
        <td><?php echo $reservation['date']; ?></td>
        <td><?php echo $reservation['time']; ?></td>
        <td><?php echo $reservation['guests']; ?></td>
        <td><br><form action="deleteProduct.php"><button>Delete</button></form></td>
    </tr>
    <?php $test++; ?>
    <?php endforeach; ?>
</table>

<br></br>
<label>© 2021 WEB PROGRAMMING INTERNATIONAL ALL RIGHTS RESERVED</label>

</html>