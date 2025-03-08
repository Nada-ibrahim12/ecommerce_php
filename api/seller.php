<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/all.min.css" />
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Seller Dashboard</h1>

        <h2>Add New Product</h2>
        <form>
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" class="form-control" placeholder="Product Name">
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" class="form-control" placeholder="Price">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" placeholder="Description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>

        <h2 class="mt-5">My Products</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sample Product</td>
                    <td>$100</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <h2 class="mt-5">Buy Requests</h2>
        <ul class="list-group">
            <li class="list-group-item">Request from Buyer 1 <button class="btn btn-success btn-sm float-end">Accept</button></li>
            <li class="list-group-item">Request from Buyer 2 <button class="btn btn-danger btn-sm float-end">Reject</button></li>
        </ul>
    </div>
</body>

</html>