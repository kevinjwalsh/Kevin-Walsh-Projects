<?php

setcookie("cookie", "", 0); // set the cookie to null

header("Location: login.php"); // redirect to login page

exit;
?>
