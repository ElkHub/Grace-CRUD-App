<?php
if (isset($_GET['id'])) {
    $connection = mysqli_connect('localhost','root','','mypcot_db');
         
    if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
    }
$id = $_GET['id'];
$sql = "DELETE FROM customer WHERE id='$id'";
if(mysqli_query($connection,$sql)){
    session_start();
    $_SESSION["delete"] = "Customer Deleted Successfully!";
    header("Location:home.php");
}else{
    die("Something went wrong");
}
}else{
    echo "Customer does not exist";
}
?>