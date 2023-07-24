<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <style>
        table  td, table th{
        vertical-align:middle;
        text-align:right;
        padding:20px!important;
        }
    </style>

   <!-- bootstrap cdn link  -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->

<section class="header">

<a href="home.php" class="logo">Grace Medical Center</a>

   <nav class="navbar">
      <a href="home.php">home</a>
      <a href="about.php">about</a>
      <a href="login.php">Logout</a>
   </nav>

</section>

<div class="container my-5">
<header class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Customer List</h1>
        <form action="home.php" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" style="width: 300px; height: 60px" placeholder="Search...">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
            <div>
            <a href="customer.php" class="btn btn-primary">Add New Customer</a>
            </div>
        </header>
        <?php
        session_start();
        if (isset($_SESSION["customer"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["customer"];
            ?>
        </div>
        <?php
        unset($_SESSION["customer"]);
        }
        ?>
         <?php
        if (isset($_SESSION["update"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["update"];
            ?>
        </div>
        <?php
        unset($_SESSION["update"]);
        }
        ?>
        <?php
        if (isset($_SESSION["delete"])) {
        ?>
        <div class="alert alert-success">
            <?php 
            echo $_SESSION["delete"];
            ?>
        </div>
        <?php
        unset($_SESSION["delete"]);
        }
        ?>
        
        <?php
        if (isset($_GET['search'])) {
         // Get the search query from the URL
         $searchQuery = $_GET['search'];
         // Connect to the database
        $connection = mysqli_connect('localhost', 'root', '', 'mypcot_db');
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Prepare the SQL query with a placeholder for the search query
        $sqlSelect = "SELECT * FROM customer WHERE name LIKE '%$searchQuery%'";

        $result = mysqli_query($connection, $sqlSelect);

        if (mysqli_num_rows($result) > 0) {
            ?>
            <table class="table table-bordered" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Gender</th>
                        <th>Medicine</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while ($data = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['password']; ?></td>
                        <td><?php echo $data['gender']; ?></td>
                        <td><?php echo $data['medicine']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "<p>No customers found.</p>";
        }

        $connection->close();
         
        }else{
         // Connect to the database
         $connection = mysqli_connect('localhost','root','','mypcot_db');
         
         if ($connection->connect_error) {
           die("Connection failed: " . $connection->connect_error);
         }
        
         $sqlSelect = "SELECT * FROM customer";
      

        $result = mysqli_query($connection, $sqlSelect);

        if (mysqli_num_rows($result) > 0) {
         ?>
         <table class="table table-bordered">
             <thead>
                 <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Password</th>
                     <th>Gender</th>
                     <th>Medicine</th>
                     <th>Action</th>
                 </tr>
             </thead>
             <tbody>
             <?php
        while($data = mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['email']; ?></td>
                <td><?php echo $data['password']; ?></td>
                <td><?php echo $data['gender']; ?></td>
                <td><?php echo $data['medicine']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-warning">Edit</a>
                    <a href="delete.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        <?php 
        } else {
         echo "<p>No customers found.</p>";
        }
        
        $connection->close();
      }
        ?>
        </tbody>
        </table>
    </div>
   