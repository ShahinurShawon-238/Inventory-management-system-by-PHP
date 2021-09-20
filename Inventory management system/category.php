<?php 
    require "database.php";
    //Product category add
    if(isset($_POST['addCat'])){
        //Get data from the input field
        $catTxt = mysqli_real_escape_string($connect,$_POST['catTxt']);
        $selectCategory = mysqli_real_escape_string($connect,$_POST['selectCategory']);
        if(!empty($_POST['catTxt']) && !empty($_POST['selectCategory'])){
            //Query for adding data into database table
            $insertCategoryQuery = "INSERT INTO category (category, status) VALUES ('$catTxt','$selectCategory') ";
            $result = mysqli_query($connect,$insertCategoryQuery);
            if($result){
                //redirecting into the page
                header('location: category.php');
            }
            else{
                echo '<script>alert("Please enter valid information")</script>';
            }
        }
    }
    //Product category delete
    if(isset($_POST['deletecat'])){
        $CatID = mysqli_real_escape_string($connect,$_POST['CatID']);
        if(!empty($CatID)){
            //query for deleting data from database table
            mysqli_query($connect, "DELETE FROM category WHERE id='$CatID'");

        }
    }
    //Update category data
    if(isset($_POST['upcat'])){
        $id=mysqli_real_escape_string($connect,$_POST['CatID']);
        $catTxt = mysqli_real_escape_string($connect,$_POST['catTxt']);
        $selectCategory = mysqli_real_escape_string($connect,$_POST['selectCategory']);
        if(!empty($id) && !empty($catTxt) && !empty($selectCategory)){
            //query for updating category data
            mysqli_query($connect, "UPDATE category SET category='$catTxt', status='$selectCategory' WHERE id = '$id' ");

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
                <h1 class="menuTxt">Our Shop-Category</h1>
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
                        <li class="nav-item active">
                            <a class="nav-link" href="category.php">Category<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="brand.php">Brand</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="product.php">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="point_of_sell.php">POS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user.php">User</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container adminmenuRowContainer">
                 <div class="row">
                     <div class="col" id="catCol1">
                         <div class="container">
                            <form action="category.php" method="POST" class="needs-validation" novalidate>
                                <div class="form-group">
                                    <label for="catTxt">Category: </label>
                                    <input type="text" class="form-control" id="catTxt" name="catTxt" placeholder="Category Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="statusselect">Status: </label>
                                    <select id="statusselect" name="selectCategory" class=" browser-default custom-select form-control" required>
                                        <option value="" disabled selected>Choose Status</option>
                                        <option value="In stock">In stock</option>
                                        <option value="Out of stock">Out of stock</option>
                                    </select>
                                </div>
                                <button type="submit" name="addCat" class="btn btn-outline-success btn-md ">Add</button>
                                
                            </form>
                            <button type="submit" name="upcat" data-toggle="modal" data-target="#upModal" class="btn btn-outline-info btn-md buttoncss">Update</button>
                            <button type="submit" name="deletecat" data-toggle="modal" data-target="#delModal" class="btn btn-outline-danger btn-md buttoncss2">Delete</button>
                        </div>
                     </div>
                     <div class="col" id="catCol2">
                        <div class="container">
                        <?php 
                        //query for selecting all data from category table
                            $showcat = mysqli_query($connect,"SELECT * FROM `category`");
                        ?>
                        <div class="scrollable">
                            <table id="scrollingtable" class="table table-striped table-bordered ">
                                <thead class="thead-dark">
                                    <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <!-- Code for Showing data in a html table -->
                                    <?php while($row = mysqli_fetch_assoc($showcat)){ ?>
                                    <tr>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['category'];?></td>
                                        <td><?php echo $row['status'];?></td>  
                                    </tr>  
                                    <?php
                                        }
                                    ?>
                                </tbody>                            
                            </table>
                        </div>
                        </div>
                     </div>
                 </div>   
            </div>
            <!-- Bootstrap modal -->
            <div class="modal fade" id="delModal">
            <div class="modal-dialog">
            <div class="modal-content">
                                    
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><img src="image/shop.png" alt="Shop" width="100px" height="100px">Delete Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                                    
            <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" action="">
                                            
                        <div class="form-group">
                            <label for="CatID">Enter Category ID to delete</label>
                            <input type="number" class="form-control" placeholder="Enter Category ID" id="CatID" name="CatID" required>
                        </div>
                        <button type="submit" name="deletecat" class="btn btn-danger float-right">Delete</button>
                    </form> 
                </div>
            </div>
            </div>
            </div>
            <div class="modal fade" id="upModal">
            <div class="modal-dialog">
            <div class="modal-content">
                                    
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><img src="image/shop.png" alt="Shop" width="100px" height="100px">Update Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                                    
            <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" action="">
                                            
                        <div class="form-group">
                            <label for="CatID">Enter Category ID to Update</label>
                            <input type="number" class="form-control" placeholder="Enter Category ID" id="CatID" name="CatID" required>
                        </div>
                        <div class="form-group">
                            <label for="catTxt">Category: </label>
                            <input type="text" class="form-control" id="catTxt" name="catTxt" placeholder="Category Name" required>
                        </div>
                        <div class="form-group">
                            <label for="statusselect">Status: </label>
                            <select id="statusselect" name="selectCategory" class=" browser-default custom-select form-control" required>
                                <option value="" disabled selected>Choose Status</option>
                                <option value="In stock">In stock</option>
                                <option value="Out of stock">Out of stock</option>
                            </select>
                        </div>
                        <button type="submit" name="upcat" class="btn btn-info float-right">Update</button>
                    </form> 
                </div>
            </div>
            </div>
            </div>
        </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script> 
<script src="js/custom.js" type="text/javascript"></script>  
</body>
</html>