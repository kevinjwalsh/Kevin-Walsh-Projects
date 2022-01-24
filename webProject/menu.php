<?php
require_once "includes/dbh.inc.php";

try {
    $dsn = 'mysql:host=localhost;dbname=restaurant';
    $username = 'root';
    $password = '';
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "<p> An error occured while connecting to the database: $error_message </p>";
}

$itemID = filter_input(INPUT_GET, 'itemID', FILTER_VALIDATE_INT);
if ($itemID == NULL || $itemID ==  FALSE) {
    $itemID = 1;
} //

$queryMenu = "SELECT * FROM menu WHERE item_id = :itemID";
$statement1 = $db->prepare($queryMenu);
$statement1->bindValue(':itemID', $itemID);
$statement1->execute();
$item = $statement1->fetch();
$item_name = $item['name'];
$statement1->closeCursor();


$queryAllMenu = 'SELECT * FROM menu ORDER BY item_id';
$statement2 = $db->prepare($queryAllMenu);
$statement2->execute();
$items = $statement2->fetchAll();
$statement2->closeCursor();

?>

<!DOCTYPE html>
<html id="menu">
<link rel="stylesheet" href="style.css">
<title>Menu</title>

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

<h1>Menu</h1>

<table>
    <tr>
        <th id="menuHead"></th>
        <th id="menuHead">Name</th>
        <th id="menuHead">Price</th>
    </tr>

    <?php foreach ($items as $item) : ?>
        <?php $test = 1; ?>
        <tr>
            <td id="menuItem"><img src=<?php echo $item['image']; ?> width=200 alt="Loading..." height=200;></td>
            <td id="menuItem"><?php echo $item['name']; ?></td>
            <td id="menuItem"><?php echo $item['price']; ?></td>
        </tr>
        <?php $test++; ?>
    <?php endforeach; ?>
</table>

<br></br>
<label>© 2021 WEB PROGRAMMING INTERNATIONAL ALL RIGHTS RESERVED</label>

</html>