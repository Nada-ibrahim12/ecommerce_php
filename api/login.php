<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/all.min.css" />
  <!-- <link rel="stylesheet" href="assets/css/style.css" /> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body class="bg-light">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg" style="width: 400px;">
      <h3 class="text-center">Login</h3>
      <form action="index.php" method="POST" id="loginForm">
        <div class="mb-3">
          <label>Email:</label>
          <input type="email" name="email" class="form-control" placeholder="Enter Email">
        </div>
        <div class="mb-3">
          <label>Password:</label>
          <input type="password" name="password" class="form-control" placeholder="Enter Password">
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
        <div class="mt-3 text-center">
          <a href="register.php">Don't have an account? Register here</a>
        </div>
      </form>
    </div>
  </div>
  <!-- <script>
    $(document).ready(function() {
      $("#loginForm").submit(function(e) {
        e.preventDefault(); 

        $.ajax({
          type: "POST",
          url: "index.php", 
          data: $(this).serialize(), 
          success: function(response) {
            alert(response); 
            $("#loginForm")[0].reset(); 
          },
          error: function() {
            alert("Something went wrong!");
          },
        });
      });
    });
  </script> -->

</body>

</html>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include 'db.php';

  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $stmt = $conn->prepare("SELECT email, password, role FROM users WHERE email=?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    session_start();
    $_SESSION['email'] = $row['email'];
    $_SESSION['role'] = $row['role'];

    if ($row['role'] == 'admin') {
      header('Location: admin.php');
    } elseif ($row['role'] == 'seller') {
      header('Location: seller.php');
    } elseif ($row['role'] == 'buyer') {
      header('Location: buyer.php');
    }
  } else {
    echo "<script>alert('Invalid Email or Password');</script>";
  }

  $stmt->close();
  $conn->close();
}

?>