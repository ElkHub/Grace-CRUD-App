<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <!-- bootstrap cdn link  -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <!-- <style>
        .error-message {
            color: red;
        }
    </style> -->
</head>
<body>

<?php

// Initialize variables to store form data and error messages
$name = $email = $password = $gender = $medicine = '';
$nameErr = $emailErr = $passwordErr = $genderErr = $medicineErr = '';
      // Check if the form was submitted
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $medicine = $_POST['medicine'];


      // Validate form fields
    if (empty($name)) {
      $nameErr = 'Name is required.';
  }
  if (empty($email)) {
      $emailErr = 'Email is required.';
  }
  if (empty($password)) {
      $passwordErr = 'Password is required.';
  } elseif (strlen($password) < 6) {
      $passwordErr = 'Password must be at least 6 characters long.';
  }
  if (empty($gender)) {
      $genderErr = 'Gender is required.';
  }
  if (empty($medicine)) {
      $medicineErr = 'Medicine is required.';
  }
  $email = strtolower($email);
    // If all fields are filled and password length is valid, proceed to database insertion
    if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($genderErr) && empty($medicineErr)) {

        // Connect to the database
        $connection = mysqli_connect('localhost', 'root', '', 'mypcot_db');

        if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
        } else {

          // Insert the user data into the database
          $sql = "INSERT INTO customer (name, email, password, gender, medicine) VALUES ('$name', '$email', '$password', '$gender', '$medicine')";

          if ($connection->query($sql) === TRUE) {
            $_SESSION["customer"] = "Record Inserted Successfully!";
            header("Location: home.php");
            exit;
          } else {
            echo "Error: Something went wrong" . $connection->error;
          }
          $connection->close();
        }
      }
      }
    ?>
   
<!-- header section starts  -->

<section class="header">

<a href="home.php" class="logo">Grace Medical Center</a>

   <nav class="navbar">
      <a href="home.php">home</a>
      <a href="about.php">about</a>
   </nav>

</section>


<div class="container my-5">
    <header class="d-flex justify-content-between my-4">
            <h1>Add New Customer</h1>
            <div>
            <a href="home.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        
        <form action="customer.php" method="post">
            <div class="form-elemnt my-4">
    <input type="text" class="form-control" name="name" style="font-size: 18px;" placeholder="Name" value="<?php echo htmlspecialchars($name); ?>">
    <span class="error-message"><?php echo $nameErr; ?></span>
</div>
<div class="form-elemnt my-4">
    <input type="email" class="form-control" style="font-size: 18px;" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
    <span class="error-message"><?php echo $emailErr; ?></span>
</div>
<div class="form-elemnt my-4">
    <input type="password" class="form-control" name="password" style="font-size: 18px;" placeholder="Password" value="<?php echo htmlspecialchars($password); ?>">
    <span class="error-message" ><?php echo $passwordErr; ?></span>
</div>
<div class="form-elemnt my-4">
    <!-- ... Your other form elements ... -->
    <select name="gender" id="" class="form-control" style="font-size: 18px;">
        <option value="">Select Gender</option>
        <option value="male" <?php if ($gender === 'male') echo 'selected'; ?>>Male</option>
        <option value="female" <?php if ($gender === 'female') echo 'selected'; ?>>Female</option>
        <option value="trans" <?php if ($gender === 'trans') echo 'selected'; ?>>Trans</option>
        <option value="other" <?php if ($gender === 'other') echo 'selected'; ?>>Other</option>
    </select>
    <span class="error-message"><?php echo $genderErr; ?></span>
</div>
<div class="form-elemnt my-4">
    <input type="text" class="form-control" name="medicine" style="font-size: 18px;" placeholder="Medicine Description" value="<?php echo htmlspecialchars($medicine); ?>">
    <span class="error-message"><?php echo $medicineErr; ?></span>
</div>
            <div class="form-element my-4">
                <input type="submit" name="customer" value="Add Customer" class="btn btn-primary">
            </div>
        </form>
        
        
    </div>
    