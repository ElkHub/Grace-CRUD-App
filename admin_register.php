<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Register</title>
<!-- font awesome cdn link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/style.css">
<style>
       *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 560px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 32px;
    text-align: center;
}

label{
    display: block;
    margin-top: 20px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 35px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 2px;
    padding: 0 6px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 30px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}

    </style>
  </head>
  <body>
  <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $connection = mysqli_connect('localhost', 'root', '', 'mypcot_db');

        if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
        } else {
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);

          $sql = "INSERT INTO admin_register (username, name, email, password) VALUES ('$username', '$name', '$email', '$hashed_password')";

          if ($connection->query($sql) === TRUE) {
            header("Location: login.php");
            exit;
          } else {
            echo "Error: " . $connection->error;
          }
          $connection->close();
        }
      }
    ?>
  
  <section class="header">

<a href="index.php" class="logo">Grace Medical Center</a>

   <nav class="navbar">
      <a>home</a>
      <a>about</a>
      <a href="login.php">Login</a>
      <a href="admin_register.php">Register</a>
   </nav>

</section>
<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
      <form action="admin_register.php" method="post">
      <h3>Register Here</h3>
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Username" id="username">
        <label for="name">Name</label>
        <input type="text" name="name" placeholder="Name" id="name">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" id="password">
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Email" id="email">
        <button>Register</button>
      </form>
  </body>
</html>





