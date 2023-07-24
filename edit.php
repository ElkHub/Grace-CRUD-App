<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Edit Customer</title>
</head>
<body>
    <div class="container my-5">
    <header class="d-flex justify-content-between my-4">
            <h1>Edit Customer</h1>
            <div>
            <a href="home.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <form action="edit.php" method="post">
            <?php 
            if (isset($_GET['id'])) {
                $connection = mysqli_connect('localhost','root','','mypcot_db');
         
                if ($connection->connect_error) {
                  die("Connection failed: " . $connection->connect_error);
                }
                $id = $_GET['id'];
                $sql = "SELECT * FROM customer WHERE id=$id";
                $result = mysqli_query($connection,$sql);
                $row = mysqli_fetch_array($result);
                ?>
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="name" placeholder="Name:" value="<?php echo $row["name"]; ?>">
            </div>
            <div class="form-elemnt my-4">
                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $row["email"]; ?>">
            </div>
            <div class="form-elemnt my-4">
                <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $row["password"]; ?>">
            </div>
            <div class="form-elemnt my-4">
                <select name="gender" id="" class="form-control">
                    <option value="">Select Gender</option>
                    <option value="Male" <?php if($row["gender"]=="Male"){echo "selected";} ?>>Male</option>
                    <option value="Female" <?php if($row["gender"]=="Female"){echo "selected";} ?>>Female</option>
                    <option value="Trans" <?php if($row["gender"]=="Trans"){echo "selected";} ?>>Trans</option>
                    <option value="Other" <?php if($row["gender"]=="Other"){echo "selected";} ?>>Other</option>
                </select>
            </div>
            <div class="form-element my-4">
                <textarea name="medicine" id="" class="form-control" placeholder="Medicine Name"><?php echo $row["medicine"]; ?></textarea>
            </div>
            <input type="hidden" value="<?php echo $id; ?>" name="id">
            <div class="form-element my-4">
                <input type="submit" name="edit" value="Update" class="btn btn-primary">
            </div>
                <?php
            }else{
                echo "<h3>Customer Does Not Exist</h3>";
            }

            if (isset($_POST["edit"])) {
                $connection = mysqli_connect('localhost','root','','mypcot_db');
         
                if ($connection->connect_error) {
                  die("Connection failed: " . $connection->connect_error);
                }
                $id = mysqli_real_escape_string($connection, $_POST["id"]);
                $name = mysqli_real_escape_string($connection, $_POST["name"]);
                $email = mysqli_real_escape_string($connection, $_POST["email"]);
                $password = mysqli_real_escape_string($connection, $_POST["password"]);
                $gender = mysqli_real_escape_string($connection, $_POST["gender"]);
                $medicine = mysqli_real_escape_string($connection, $_POST["medicine"]);
            
                $sqlUpdate = "UPDATE customer SET name = '$name', email = '$email', password = '$password', gender = '$gender', medicine = '$medicine' WHERE id = $id";
                if(mysqli_query($connection,$sqlUpdate)){
                    session_start();
                    $_SESSION["update"] = "Customer Updated Successfully!";
                    header("Location:home.php");
                    exit();
                }else{
                    die("Something went wrong");
                }
            }
            ?>
            
           
        </form>
        
        
    </div>
</body>
</html>