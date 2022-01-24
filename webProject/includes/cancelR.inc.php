<?php
$dsn='mysql:host=localhost;dbname=restaurant';
$username='root';
$password='';

try {
    $db=new PDO($dsn, "root","");
    echo 'Connected successfully';
    }
    catch (PDOException  $e)
    {
        $error=$e->getMessage();
        echo  '<p> Unable to connec to the database: '.$error;
        exit();
     }

     $id = $_POST['id'];

     $query2="DELETE FROM reservations WHERE reservation_id='$id'";
     $row=$db->exec($query2);

     header("localhost/webProject/reservationList.php");
     $location='location:../reservationList.php';
     header($location);
?>


