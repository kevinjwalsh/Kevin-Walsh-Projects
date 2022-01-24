<?php
require_once "dbh.inc.php";
?>

<?php
	include_once 'dbh.inc.php';

    if (isset($_COOKIE["cookie"])) {
        $sql = "SELECT user_id FROM users WHERE name = '" . $_COOKIE["cookie"] . "'";

        if ($result = $conn->query($sql)) {
            $user_id = $result->fetch_object()->user_id;
        }
    }

	$name = $_POST['name'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$guests = $_POST['guests'];

	$sql = "INSERT INTO reservations (name, date, time, guests, user_id) VALUES ('$name', '$date', '$time', '$guests', '$user_id');";
	mysqli_query($conn, $sql);

	header("localhost/webProject/confirmReserve.php");
     $location='location:../confirmReserve.php';
     header($location);

	
