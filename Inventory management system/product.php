<?php 
    require "database.php";
    //Add data in product table
    if(isset($_POST['productaddbutton'])){
        //Get data from input field
        $productName = mysqli_real_escape_string($connect,$_POST['productName']);
        $prodes = mysqli_real_escape_string($connect,$_POST['prodes']);
        $selectprocat = mysqli_real_escape_string($connect,$_POST['selectprocat']);
        $selectprobra = mysqli_real_escape_string($connect,$_POST['selectprobra']);
        $costprice = mysqli_real_escape_string($connect,$_POST['costprice']);
        $retailprice = mysqli_real_escape_string($connect,$_POST['retailprice']);
        $quantity = mysqli_real_escape_string($connect,$_POST['quantity']);
        $barcode = mysqli_real_escape_string($connect,$_POST['barcode']);
        $productStatus = mysqli_real_escape_string($connect,$_POST['productStatus']);

        if(!empty($productName) && !empty($prodes) && !empty($selectprocat) && !empty($selectprobra) && !empty($costprice) && !empty($retailprice) && !empty($quantity) && !empty($barcode) && !empty($productStatus) && !empty($_FILES['image']['name'])){
           //get image, file type and name
            $file_type = $_FILES['image']['type']; 
            //set some allowed image type
            $allowed = array("image/jpeg", "image/jpg", "image/png");
            if(!in_array($file_type, $allowed)) {
                echo '<script>alert("Only jpg, jpeg, and png files are allowed.")</script>';
              }
            else{
                //move image and image name in a folder under project folder
                move_uploaded_file($_FILES['image']['tmp_name'], "productPhoto/".$_FILES['image']['name']);
                $img="productPhoto/".$_FILES['image']['name'];
                //insert all product data in product table 
                $result = mysqli_query($connect,"INSERT INTO `product`(`product`, `image`, `description`, `category`, `brand`, `cost_price`, `retail_price`, `quantity`, `barcode`, `status`) VALUES ('$productName', '$img', '$prodes','$selectprocat','$selectprobra', '$costprice','$retailprice','$quantity','$barcode','$productStatus')");
                if($result){
                    //redirecting the page
                    header('location: product.php');
                }
                else{
                    echo '<script>alert("Please enter valid information")</script>';
                }
            }
        }

    }
    //delete product data from product table
    if(isset($_POST['deleteProduct'])){
        $ProductID = mysqli_real_escape_string($connect,$_POST['ProductID']);
        if(!empty($ProductID)){
            //query for deleting data
            mysqli_query($connect, "DELETE FROM product WHERE id='$ProductID'");

        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="shortcut icon" href="image/shop.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=PT+Sans:wght@400;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7364b90ec9.js" crossorigin="anonymous"></script>
</head>
<body id="adminMenu">
        <div class="container">
            <a href="admin_menu.php"><img class="menuLogo" src="image/shop.png" alt="logo"></a>
            <div class="text-center">
                <h1 class="menuTxt">Our Shop-Product</h1>
                <div class="float-right imageshowbox">
                    <a href="index.php" class="btn btn-sm btn-danger"data-toggle="tooltip" data-placement="bottom" title="LogOut"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-dark">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="category.php">Category</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="brand.php">Brand</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="product.php">Product<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="point_of_sell.php">POS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user.php">User</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container adminmenuRowContainer" id="productContainer">
                <?php 
                //Getting product id while need to update
                    if(isset($_GET['edit'])){
                        $id=$_GET['edit'];
                        $sql = mysqli_query($connect,"SELECT * FROM product WHERE id=$id");
                        $fetch_row = mysqli_fetch_assoc($sql);
                    }
                    //update product data
                    if(isset($_POST['updateProduct'])){
                        $id=mysqli_real_escape_string($connect, $_POST['id']);
                        $productName =mysqli_real_escape_string($connect, $_POST['productName']);
                        $prodes =mysqli_real_escape_string($connect, $_POST['prodes']);
                        $selectprocat =mysqli_real_escape_string($connect, $_POST['selectprocat']);
                        $selectprobra =mysqli_real_escape_string($connect, $_POST['selectprobra']);
                        $costprice =mysqli_real_escape_string($connect, $_POST['costprice']);
                        $retailprice =mysqli_real_escape_string($connect, $_POST['retailprice']);
                        $quantity =mysqli_real_escape_string($connect, $_POST['quantity']);
                        $barcode =mysqli_real_escape_string($connect, $_POST['barcode']);
                        $productStatus =mysqli_real_escape_string($connect, $_POST['productStatus']);
                
                        if(!empty($productName) && !empty($prodes) && !empty($selectprocat) && !empty($selectprobra) && !empty($costprice) && !empty($retailprice) && !empty($quantity) && !empty($barcode) && !empty($productStatus) && !empty($_FILES['image']['name'])){
                            $file_type = $_FILES['image']['type']; 
                            $allowed = array("image/jpeg", "image/jpg", "image/png");
                            if(!in_array($file_type, $allowed)) {
                                echo '<script>alert("Only jpg, jpeg, and png files are allowed.")</script>';
                              }
                            else{
                                move_uploaded_file($_FILES['image']['tmp_name'], "productPhoto/".$_FILES['image']['name']);
                                $img="productPhoto/".$_FILES['image']['name'];
                                //query for update product data
                                mysqli_query($connect,"UPDATE `product` SET product='$productName', image='$img', description='$prodes', category='$selectprocat', brand='$selectprobra', cost_price='$costprice', retail_price='$retailprice', quantity='$quantity', barcode='$barcode', status='$productStatus' WHERE id = '$id' ");
                                
                            }
                        }
                    }
                    
                ?>
                <form action="product.php" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col">      
                            <!-- Code for showing data again in a form while need to edit and update -->
                            <input type="hidden" name="id" value="<?php echo $fetch_row['id']?>">                    
                            <div class="form-group">
                                <!-- <label for="productName">Product: </label> -->
                                <input type="text" value="<?php if(empty($_GET['edit'])){ } else{echo $fetch_row['product'];} ?>" class="form-control" id="productName" name="productName" placeholder="Product Name" required>
                            </div>
                            <div class="form-group">
                                <!-- <label for="prodes">Description: </label> -->
                                <textarea class="form-control" rows="1" id="prodes" name="prodes" placeholder="Product Description" required><?php if(empty($_GET['edit'])){ } else{echo $fetch_row['description'];} ?></textarea>
                            </div>
                            <div class="form-group">
                                <!-- <label for="catselect">Category: </label> -->
                                <select id="catselect" value="" name="selectprocat" class=" browser-default custom-select form-control" required>
                                    <?php 
                                        $showcat = mysqli_query($connect,"SELECT * FROM `category`");
                                    ?>
                                    <!-- Showing category name in product page with combo box -->
                                    <option value="" disabled selected>Choose Category</option>
                                    <?php while($row = mysqli_fetch_assoc($showcat)){ ?>
                                    <option value="<?php echo $row['category']?>"><?php echo $row['category']?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <!-- <label for="braselect">Status: </label> -->
                                <select id="braselect" name="selectprobra" class=" browser-default custom-select form-control" required>
                                <?php 
                                        $showbra = mysqli_query($connect,"SELECT * FROM `brand`");
                                    ?>
                                    <!-- Showing brand name in product page with combo box -->
                                    <option value="" disabled selected>Choose Brand</option>
                                    <?php while($row = mysqli_fetch_assoc($showbra)){ ?>
                                    <option value="<?php echo $row['brand']?>"><?php echo $row['brand']?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <!-- <label for="costprice">Cost Price: </label> -->
                                <input type="number" min="0" value="<?php echo $fetch_row['cost_price']?>" class="form-control" id="costprice" name="costprice" placeholder="Cost price" required>
                            </div>

                        </div>
                        <div class="col">                            
                            <div class="form-group">
                                <!-- <label for="retailprice">Retail Price: </label> -->
                                <input type="number" min="0" value="<?php echo $fetch_row['retail_price']?>" class="form-control" id="retailprice" name="retailprice" placeholder="Retail price" required>
                            </div>
                            <div class="form-group">
                                <!-- <label for="quantity">Quantity: </label> -->
                                <input type="number" min="0" value="<?php echo $fetch_row['quantity']?>" class="form-control" id="quantity" name="quantity" placeholder="Quantity" required>
                            </div>
                            <div class="form-group">
                                <!-- <label for="barcode">Bar Code: </label> -->
                                <input type="text" value="<?php if(empty($_GET['edit'])){ } else{echo $fetch_row['barcode'];} ?>" class="form-control" id="barcode" name="barcode" placeholder="BarCode" required>
                            </div>
                            <div class="form-group">
                                    <!-- <label for="Productselect">Status: </label> -->
                                    <select id="Productselect" name="productStatus" class=" browser-default custom-select form-control" required>
                                        <option value="" disabled selected>Choose Status</option>
                                        <option value="In stock">In stock</option>
                                        <option value="Out of stock">Out of stock</option>
                                    </select>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-sm-2 col-form-label">Image: </label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="image" name="image" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-success btn-md productaddbutton" name="productaddbutton">Add Product</button>
                            <button type="submit" class="btn btn-outline-info btn-md productbtn" name="updateProduct">Update Product</button>
                        </div>
                    </div>
                </form>
                
                
                <div class="box">
                    <!-- Showing all product in a html table -->
                    <?php 
                        $showproduct = mysqli_query($connect,"SELECT * FROM `product`");
                    ?>
                    <div class="scrollable">
                        <table id="scrollingtable" class="table table-striped table-bordered ">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">CostPrice</th>
                                    <th scope="col">RetailPrice</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">BarCode</th>
                                    <th scope="col">Status</th>                
                                    <th scope="col">Edit</th>                
                                </tr>
                            </thead>        
                            <tbody>
                            <?php while($row = mysqli_fetch_assoc($showproduct)){ ?>
                            <tr>
                                <td><?php echo $row['id'];?></td>
                                <td><?php echo $row['product'];?></td>
                                <td><img src="<?php echo $row['image'];?>" alt="Photo"></td>
                                <td><?php echo $row['description'];?></td>
                                <td><?php echo $row['category'];?></td>  
                                <td><?php echo $row['brand'];?></td>  
                                <td><?php echo $row['cost_price'];?></td>  
                                <td><?php echo $row['retail_price'];?></td>  
                                <td><?php echo $row['quantity'];?></td>  
                                <td><?php echo $row['barcode'];?></td>  
                                <td><?php echo $row['status'];?></td>  
                                <td><a class="edit_btn" href="product.php?edit=<?php echo $row['id']; ?>">Edit</a></td>
                            </tr>  
                            <?php
                                }
                            ?>
                            </tbody>                            
                        </table>
                    </div> 
                </div>  
                <button type="submit" class="btn btn-outline-danger btn-md productbtn" data-toggle="modal" data-target="#delModal" name="deleteProduct">Delete Product</button>              
            </div>
            <!-- Bootstrap modal -->
            <div class="modal fade" id="delModal">
            <div class="modal-dialog">
            <div class="modal-content">
                                    
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><img src="image/shop.png" alt="Shop" width="100px" height="100px">Delete Product</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                                    
            <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" action="">
                                            
                        <div class="form-group">
                            <label for="ProductID">Enter Product ID to delete</label>
                            <input type="number" class="form-control" placeholder="Enter Product ID" id="ProductID" name="ProductID" required>
                        </div>
                        <button type="submit" name="deleteProduct" class="btn btn-danger float-right">Delete</button>
                    </form> 
                </div>
            </div>
            </div>
            </div>
        </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>     
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="js/custom.js" type="text/javascript"></script>  
</body>
</html>