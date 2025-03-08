<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 500px;">
            <h3 class="text-center">Register</h3>
            <form action="register.php" method="POST" id="registerForm" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Name">
                </div>
                <div class="mb-3">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Email">
                </div>
                <div class="mb-3">
                    <label>Password:</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                </div>
                <div class="mb-3">
                    <label>Role:</label>
                    <select class="form-select" id="userRole" name="role">
                        <option value="buyer">Buyer</option>
                        <option value="seller">Seller</option>
                    </select>
                </div>

                <!-- Seller Extra Fields -->
                <div id="sellerFields" style="display: none;">
                    <div class="mb-3">
                        <label>Company Name:</label>
                        <input type="text" name="company_name" class="form-control" placeholder="Enter Company Name">
                    </div>
                    <div class="mb-3">
                        <label>Phone Number:</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter Phone">
                    </div>
                    <div class="mb-3">
                        <label>ID Picture:</label>
                        <input type="file" name="id_image" class="form-control" accept="image/*">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100" name="submit">Register</button>
                <div class="mt-3 text-center">
                    <a href="index.php">Have an account? Login here</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("userRole").addEventListener("change", function() {
            let role = this.value;
            if (role === "seller") {
                document.getElementById("sellerFields").style.display = "block";
            } else {
                document.getElementById("sellerFields").style.display = "none";
            }
        });
    </script>
    <!-- <script>
        $(document).ready(function() {
            $("#registerForm").submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "register.php",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert(response);
                        $("#registerForm")[0].reset();
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
include 'db.php';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];
    $company_name = isset($_POST['company_name']) ? $_POST['company_name'] : null;
    $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
    $id_image = null;

    if ($role == 'seller' && !empty($_FILES['id_image']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["id_image"]["name"]);
        move_uploaded_file($_FILES["id_image"]["tmp_name"], $target_file);
        $id_image = $target_file;
    }

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role, company_name, phone, id_image) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $password, $role, $company_name, $phone, $id_image);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
