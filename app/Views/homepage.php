<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab 1</title>

   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">


    <style>
        body {
            font-family: 'Georgia', Georgia;
            background-color: #ede7f6; 
        }

        h3 {
            color: #7b1fa2; 
        }

        .btn-primary {
            background-color: #7b1fa2;
            border-color: #6a1b9a;
        }

        .btn-primary:hover {
            background-color: #6a1b9a;
            border-color: #4a148c;
        }

        .btn-danger {
            background-color: #d32f2f;
            border-color: #c62828;
        }

        .btn-danger:hover {
            background-color: #c62828;
            border-color: #b71c1c;
        }

        .table {
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
			width: 80%;

        }

        .table th {
            background-color: #7b1fa2; 
            color: #fff;
        }

        ul {
            background-color: #f3e5f5; 
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        ul li {
            margin-bottom: 9px;
        }
    </style>
</head>
<center>
<body style="background-color: #f3e5f5;">
    <div class="grid text-left">

        <div class="g-col-4">
            <div class="g-col-4">
                <div class="g-col-4">
				
                    <h3>Crud Laboratory</h3>
                    <br>
                    <form action="/insert" method="post">
                        <input type="hidden" name="ID" value="<?= isset($user['ID']) ? $user['ID'] : '' ?>">
                        <div class="row">
                            
							<center>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ProdName" class="form-label">Product-Name</label>
                                    <input type="text" class="form-control" name="ProdName" id="ProdName" placeholder="Enter Name" value="<?= isset($user['ProductName']) ? $user['ProductName'] : '' ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="ProdDesc" class="form-label">Product-Description</label>
                                    
                                    <input type="text" class="form-control" name="ProdDesc" id="ProdDesc" placeholder="Enter Description" value="<?= isset($user['ProductDescription']) ? $user['ProductDescription'] : '' ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="ProdCat" class="form-label">Product-Category</label>
                                <input type="text" class="form-control" name="ProdCat" id="ProdCat" placeholder="Enter New Category" value="<?= isset($user['ProductCategory']) ? $user['ProductCategory'] : '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="SelectProdCat" class="form-label">Select Category</label>

                                <select class="form-select d-inline-block ml-2" name="SelectProdCat" id="SelectProdCat">
                                    <?php
                                    foreach ($activity as $us) {
                                        echo "<option>{$us['ProductCategory']}</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>

                        <script>
                            document.getElementById('SelectProdCat').addEventListener('change', function() {
                                var selectedValue = this.value;
                                document.getElementById('ProdCat').value = selectedValue;
                            });
                        </script>

                        <div class="mb-3">
                            <label for="ProdQuan" class="form-label">Product-Quantity</label>
                            <input type="text" class="form-control" name="ProdQuan" id="ProdQuan" placeholder="Enter Quantity" value="<?= isset($user['ProductQuantity']) ? $user['ProductQuantity'] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="ProdPr" class="form-label">Product-Price</label>
                            <input type="text" class="form-control" name="ProdPr" id="ProdPr" placeholder="Enter Price" value="<?= isset($user['ProductPrice']) ? $user['ProductPrice'] : '' ?>">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="/activity" class="btn btn-primary">New</a>
            </form>

			<div class="mt-5">
    <br>
    <select class="form-select d-inline-block ml-2" id="categoryFilter" style="width: 20%;">
        <option value="All">All</option>
        <?php
        foreach ($activity as $us) {
            echo "<option>{$us['ProductCategory']}</option>";
        }
        ?>
    </select>
</div>
			
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ProductName</th>
                        <th>ProductDescription</th>
                        <th>ProductCategory</th>
                        <th>ProductQuantity</th>
                        <th>ProductPrice</th>
                        <th>Update | Remove</th>
                    </tr>
                </thead>
				<center>
                <tbody>
                    <?php foreach ($activity as $us): ?>
                        <tr data-category="<?= $us['ProductCategory'] ?>">
                            <td><?= $us['ID'] ?></td>
                            <td><?= $us['ProductName'] ?></td>
                            <td><?= $us['ProductDescription'] ?></td>
                            <td><?= $us['ProductCategory'] ?></td>
                            <td><?= $us['ProductQuantity'] ?></td>
                            <td><?= $us['ProductPrice'] ?></td>
                            <td>
                                <a href="/edit/<?= $us['ID']?>" class="btn btn-primary">Edit</a>
                                <a href="/delete/<?= $us['ID']?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <script>
                document.getElementById('categoryFilter').addEventListener('change', function() {
                    var selectedCategory = this.value;
                    var rows = document.querySelectorAll('tbody tr');
                    rows.forEach(function(row) {
                        var rowCategory = row.getAttribute('data-category');
                        if (selectedCategory === 'All' || selectedCategory === rowCategory) {
                            row.style.display = 'table-row';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            </script>

            <div class="mt-5">

                <h3 class="d-inline-block">Product List</h3>
                <br>
                <br>
                <ul style="list-style-type:circle">

                    <?php foreach ($activity as $us): ?>
                        <li><b>ID: </b><?= $us['ID'] ?></li>
                        <li><b>ProductName: </b><?= $us['ProductName'] ?></li>
                        <li><b>Product Description: </b><?= $us['ProductDescription'] ?></li>
                        <li><b>Product Category: </b><?= $us['ProductCategory'] ?></li>
                        <li><b>Product Quantity: </b><?= $us['ProductQuantity'] ?></li>
                        <li><b>Product Price: </b><?= $us['ProductPrice'] ?></li>
                        <li>
                            <a href="/edit/<?= $us['ID']?>" class="btn btn-primary">Edit</a>
                            <a href="/delete/<?= $us['ID']?>" class="btn btn-danger">Delete</a>
                        </li>
                        <br>
                    <?php endforeach; ?>
                </ul>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </div>
    </div>
</body>
					</center>
</html>
