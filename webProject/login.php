<?php
require_once "includes/dbh.inc.php";

// if already logged in, redirect to homepage
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

$login_err = $signup_err = "";

// process LOGIN form data
if(!isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["pswd"])) {
    $email = addslashes(trim($_POST["email"]));
    $sql = "SELECT email, pswd FROM users WHERE email = '". $email ."'";

    $result = $conn->query($sql);
    if (mysqli_num_rows($result) == 1) {
        $user = $result->fetch_object();
        $hash = $user->pswd;

        if(password_verify(trim($_POST["pswd"]), $hash)) {

            // create cookie
            $getName = "SELECT name FROM users WHERE email = '". $_POST["email"] ."'";
            $result = $conn->query($getName);
            if (mysqli_num_rows($result) == 1) {
                $name = $result->fetch_object()->name;
                setcookie("cookie", $name, '0');
            }

            header("Location: index.php");
        } else {
            $login_err = "Email or Password were incorrect.";
        }
    } else {
        $login_err = "Email or Password were incorrect.";
    }
}
    // process SIGNUP form data
    if(isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_POST["pswd"]) && isset($_POST["conPswd"])) {
		$name = addslashes(trim($_POST["name"]));
        $phone = addslashes(trim($_POST["phone"]));
        $email = addslashes(trim($_POST["email"]));
        $passHash = password_hash(trim($_POST["pswd"]), PASSWORD_DEFAULT);

        $insertSql = "INSERT INTO users (name, phone, email, pswd) VALUES ('$name', '$phone', '$email', '$passHash');";
    
        if($_POST["pswd"] == $_POST["conPswd"] && $_POST["pswd"] != "") {
            if($conn->query($insertSql) === TRUE) {
                $sql = "SELECT name FROM users WHERE name = '". $name ."'";
                $result = $conn->query($sql);
                
                // create cookie
                if (mysqli_num_rows($result) == 1) {
                    $name = $result->fetch_object()->$name;
                    setcookie("cookie", $name, 0, '/');
                    header("Location: login.php");
                }
            } else {
                // Checks for duplicate email
                if($conn->errno == 1062) {
                    $register_err = "That email has already been used.";
                } else {
                    $register_err = "Could not create user.";
                }
            }                        
        } else {
            $register_err = "Passwords do not match.";
        }
    }
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<title>Login</title>

<header>
    <a href="./index.php" class="logo">
    <h2>Quick Bytes</h2>    </a>
</header>

<h1>Login</h1>
<form id="login" method="post">
	<label>Email:</label>
	<input type="email" name="email">
	<br></br>
	<label>Password:</label>
	<input type="password" name="pswd">
	<br></br>
    <?php // process LOGIN error
    if(!empty($login_err)){
        echo '<div class="error">' . $login_err . '</div><br>';
        }    
    ?>
	<button class="button-73" role="button" type="submit">Sign In</button>
</form>

<br><h1>Create an Account</h1>
<form id="login" method="post">
	<label>Name:</label>
	<input type="text" name="name" required>
	<br><br>
	<label>Phone Number:</label>
	<input type="tel" name= "phone" required>
	<br><br>
	<label>Email:</label>
	<input type="email" name="email" required>
	<br><br>
	<label>Password:</label>
	<input type="password" name="pswd" required>
	<br><br>
	<label>Confirm Password:</label>
	<input type="password" name="conPswd" required>
	<br><br>
    <?php // process SIGNUP error
    if(!empty($register_err)){
        echo '<div class="error">' . $register_err . '</div><br>';
        }    
    ?>
	<button class="button-73" role="button" type="submit" name="submit">Sign Up</button>
</form>

<br></br>
<label>© 2021 WEB PROGRAMMING INTERNATIONAL ALL RIGHTS RESERVED</label>

</html>