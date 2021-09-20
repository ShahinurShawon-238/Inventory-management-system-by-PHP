<?php 
    require "database.php";
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
<body id="UserMenu">
    <div class="container">
        <a href="user_menu.php"><img class="menuLogo" src="image/shop.png" alt="logo"></a>
            <div class="text-center">
                <h1 class="menuTxt">Our Shop-Product</h1>
                <div class="float-right imageshowbox">
                    <!-- Show user name -->
                <?php  if (isset($_SESSION['name'])) : ?> 
                     <b>
                         <?php echo $_SESSION['name']?>
                     </b>
                     <a href="index.php" class="btn btn-sm btn-danger"data-toggle="tooltip" data-placement="bottom" title="LogOut"><i class="fas fa-sign-out-alt"></i></a>
                </div>
                <?php endif ?>
            </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link active" href="user_product.php">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="point_of_buy.php">Point Of Buy</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container usermenuRowContainer" id= "userproductContainer">
            <div class="box">
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
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">BarCode</th>
                                    <th scope="col">Status</th>                
                                </tr>
                            </thead>        
                            <tbody>
                            <?php while($row = mysqli_fetch_assoc($showproduct)){ ?>
                                <!-- Show product -->
                            <tr>
                                <td><?php echo $row['id'];?></td>
                                <td><?php echo $row['product'];?></td>
                                <td><img src="<?php echo $row['image'];?>" alt="Photo"></td>
                                <td><?php echo $row['description'];?></td>
                                <td><?php echo $row['category'];?></td>  
                                <td><?php echo $row['brand'];?></td>
                                <td><?php echo $row['retail_price'];?></td>  
                                <td><?php echo $row['quantity'];?></td>  
                                <td><?php echo $row['barcode'];?></td>  
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="js/custom.js" type="text/javascript"></script>  
</body>
</html>