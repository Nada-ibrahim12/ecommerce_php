<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center">Admin Panel</h2>
        <h3>Users</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';
                $stmt = $conn->prepare("SELECT * FROM users Where approved = 1");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($data = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $data['id'] . "</td>";
                        echo "<td>" . $data['name'] . "</td>";
                        echo "<td>" . $data['email'] . "</td>";
                        echo "<td>" . $data['role'] . "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-danger btn-sm' onClick='deleteUser(" . $data['id'] . ")'>Remove User</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='5'>No users found</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <h3>Pending Sellers</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>ID Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';
                $stmt = $conn->prepare("SELECT * FROM users Where approved = 0");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($data = $result->fetch_assoc()) {

                        echo "<tr>";
                        echo "<td>" . $data['id'] . "</td>";
                        echo "<td>" . $data['name'] . "</td>";
                        echo "<td>" . $data['email'] . "</td>";
                        echo "<td>" . $data['phone'] . "</td>";
                        echo "<td><img src='uploads/" . $data['id_image'] . "' width='100'></td>";
                        echo "<td>";
                        echo "<button class='btn btn-success btn-sm' onclick='approveBuyer(" . $data['id'] . ")'> Approve</button>";
                        echo "<button class='btn btn-danger btn-sm' onclick= 'declineBuyer(" . $data['id'] . ")'>Decline</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='7'>No pending sellers found</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function approveBuyer(id) {
            $.ajax({
                url: 'manageUsers.php',
                type: 'GET',
                data: {
                    id: id,
                    action: 'approve'
                },
                success: function(response) {
                    if (response === 'success') {
                        alert("Buyer Approved!");
                        location.reload();
                    } else {
                        alert("Something went wrong!");
                    }
                }
            });
        }

        function declineBuyer(id) {
            $.ajax({
                url: 'manageUsers.php',
                type: 'GET',
                data: {
                    id: id,
                    action: 'decline'
                },
                success: function(response) {
                    if (response === 'success') {
                        alert("Buyer Declined!");
                        location.reload();
                    } else {
                        alert("Something went wrong!");
                    }
                }
            });
        }

        function deleteUser(id) {
            $.ajax({
                url: 'manageUsers.php',
                type: 'GET',
                data: {
                    id: id,
                    action: 'delete'
                },
                success: function(response) {
                    if (response === 'success') {
                        alert("User Deleted!");
                        location.reload();
                    } else {
                        alert("Something went wrong!");
                    }
                }
            });
        }
    </script>
</body>

</html>