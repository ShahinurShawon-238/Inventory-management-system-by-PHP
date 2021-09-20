<?php 
    require "database.php";
      //get paid amount and store in session variable
    if(isset($_POST['buy'])){
        $paidamount = mysqli_real_escape_string($connect,$_POST['paidamount']);
        $_SESSION['paidamount']=$paidamount;
    }
    
    //clear the product cart
    if(isset($_POST['clear'])){
        mysqli_query($connect,"DELETE FROM productcart");
        //remove paid amount from session variable
        unset($_SESSION['paidamount']);
        //query for starting the increment from the beginning after deleting table data
        mysqli_query($connect,"ALTER TABLE `productcart` AUTO_INCREMENT=1");
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
<body id="UserMenu">
        <div class="container">
            <a href="user_menu.php"><img class="menuLogo" src="image/shop.png" alt="logo"></a>
            <div class="text-center">
                <h1 class="menuTxt">Our Shop-Point Of Buy</h1>
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
                        <li class="nav-item">
                            <a class="nav-link" href="user_product.php">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="point_of_buy.php">Point Of Buy</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container usermenuRowContainer">
            <!-- getting data from product table -->
                <?php 
                    if(isset($_POST['enterbutton'])){
                        $barcode = mysqli_real_escape_string($connect,$_POST['barcode']);
                        $query = mysqli_query($connect,"SELECT * FROM product WHERE barcode='$barcode'");
                        $checkRow = mysqli_num_rows($query);
                        if(!$checkRow==0){
                            $_SESSION['barcode']=$barcode;
                            $row = mysqli_fetch_assoc($query); 
                        }
                        else{
                            echo '<script>alert("BarCode not found")</script>';
                            header('location: point_of_sell.php');
                        }
                        
                    }
                    //add product in product cart
                    if(isset($_POST['addproduct'])){
                        $productCode = $_SESSION['barcode'];
                        $productName = mysqli_real_escape_string($connect,$_POST['productName']);
                        $price = mysqli_real_escape_string($connect,$_POST['price']);
                        $newQuantity = mysqli_real_escape_string($connect,$_POST['quantity']);
                        //$_SESSION['newquantity']=$newQuantity;

                        $quantityCheckquery = mysqli_query($connect,"SELECT quantity FROM product WHERE barcode='$productCode'");
                        $checkRow = mysqli_num_rows($quantityCheckquery);
                        if(!$checkRow==0){
                            $row = mysqli_fetch_assoc($quantityCheckquery); 
                            $availableQuantity = $row['quantity'];
                            $_SESSION['availableQuantity']=$availableQuantity;
                            if($newQuantity>$availableQuantity){
                                echo '<script>alert("Quantity is more than available quantity")</script>';
                                //echo $availableQuantity." is available";
                            }
                            else{
                                $total = $price * $newQuantity;
                                $query = "INSERT INTO productcart (productcode, productname, price, quantity, total) VALUES ('$productCode','$productName','$price','$newQuantity','$total')";
                                $result = mysqli_query($connect,$query);
                                if(!$result){
                                    echo '<script>alert("Please enter valid information")</script>';
                                }
                                else{
                                    //update quantity of product after adding product in product table
                                    $updatequantity = $availableQuantity-$newQuantity;
                                    $_SESSION['updatequantity']=$updatequantity;
                                    mysqli_query($connect,"UPDATE product SET quantity='$updatequantity' WHERE barcode='$productCode'");
                                }
                                
                            }
                        }

                    }
                    //delete product cart data and store the quantity again in product table
                    if(isset($_POST['deleteproductcart'])){
                        $productCode = $_SESSION['barcode'];
                        $productCartID = mysqli_real_escape_string($connect,$_POST['productCartID']);
                        if(!empty($productCartID)){
                            $productcartquantity = mysqli_query($connect, "SELECT quantity FROM productcart WHERE id='$productCartID'");
                            $productcartquantityget = mysqli_fetch_assoc($productcartquantity);
                            $_SESSION['productcartquantity']=$productcartquantityget['quantity'];
                            $newQuantity2 = $_SESSION['updatequantity']+$_SESSION['productcartquantity'];
                            mysqli_query($connect,"UPDATE product SET quantity='$newQuantity2' WHERE barcode='$productCode'");
                            mysqli_query($connect, "DELETE FROM productcart WHERE id='$productCartID'");

                        }
                    }
                    //update product quantity in product cart
                    if(isset($_POST['upquantity'])){
                        $id = mysqli_real_escape_string($connect,$_POST['id']);
                        $quantity = mysqli_real_escape_string($connect,$_POST['quantity']);
                        mysqli_query($connect,"UPDATE productcart SET quantity='$quantity' WHERE id='$id'");
                        //$updatequantity = $_SESSION['availableQuantity']-$quantity;
                        //mysqli_query($connect,"UPDATE product SET quantity='$updatequantity' WHERE barcode='($_SESSION['barcode'])'");
                
                    }
                ?>
                <div class="box1">
                    
                    <div class="row">
                        <div class="col-md-3">
                            <form action="point_of_buy.php" method="post" class="needs-validation" novalidate>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <!-- <label for="barcode">Product Code: </label> -->
                                            <input type="text" class="form-control" id="barcode" name="barcode" value="<?php if(empty($_POST['barcode'])){ } else{echo $_SESSION['barcode'];} ?>" placeholder="Product Barcode" required>
                                            <button type="submit" class="btn btn-md btn-primary" id="Enter_Button"  data-toggle="tooltip" data-placement="bottom" title="Enter to select product" name="enterbutton">Enter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-9">
                            <form action="point_of_buy.php" method="post" class="needs-validation" novalidate>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <!-- <label for="productName">Product: </label> -->
                                            <input type="text" class="form-control" value="<?php if(empty($_POST['barcode'])){ } else{echo $row['product'];} ?>" id="productName" name="productName" placeholder="Product Name">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <!-- <label for="price">Price: </label> -->
                                            <input type="number" min="0" class="form-control" value="<?php echo $row['retail_price']?>" id="price" name="price" placeholder="Price">
                                    </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <!-- Getting data from url -->
                                            <?php 
                                                if(isset($_GET['edit'])){
                                                    $id=$_GET['edit'];
                                                    $edit_state = true;
                                                    $sql = mysqli_query($connect,"SELECT * FROM productcart WHERE id=$id");
                                                    $fetch_row = mysqli_fetch_assoc($sql);
                                                }
                                            ?>
                                            <!-- <label for="quantity">Quantity: </label> -->
                                            <input type="hidden" name="id" value="<?php echo $fetch_row['id']?>">   
                                            <input type="number" class="form-control" min="0" value="<?php echo $fetch_row['quantity']?>" id="quantity" data-toggle="tooltip" data-placement="bottom" title="Won't be able to change quantity without deleting" name="quantity" placeholder="Quantity" required>
                                            <?php if ($edit_state == false): ?>
                                            <button type="submit" name="addproduct" class="btn btn-outline-success btn-lg addButton">Add Product</button>
                                            <?php else: ?>
                                            <button type="submit" name="upquantity" class="btn btn-outline-success btn-md addButton">Update Product</button>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>                       
                            </form>  
                        </div>
                    </div>                  
                </div>    
                <div class="box2 productcarttable">
                    <div class="row">
                        <div class="col-md-10">
                        <?php 
                            $showproductcart = mysqli_query($connect,"SELECT * FROM `productcart`");
                            
                        ?>
                            <div class="scrollable">
                                <table id="scrollingtable" class="table table-striped table-bordered ">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Product Code</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php while($row = mysqli_fetch_assoc($showproductcart)){  $productcart_id=$row['id'];$upproductquantity = $row['productcode'];?>
                                        <!-- Showing data in a table -->
                                        <tr>
                                            <td><?php echo $productcart_id;?></td>
                                            <td><?php echo $row['productcode'];?></td>
                                            <td><?php echo $row['productname'];?></td>
                                            <td><?php echo $row['price'];?></td>  
                                            <td><?php echo $row['quantity'];?></td>  
                                            <!-- edit button in the quantity column -->
                                            <!-- &nbsp;&nbsp;&nbsp;<a class="edit_btn" href="point_of_sell.php?edit=<?php //echo $row['id'];?>">Edit</a> -->
                                            <td><?php echo $row['total'];?></td>  
                                            
                                        </tr>  
                                        <?php
                                            }
                                        ?>
                                    </tbody>                            
                                </table>
                            </div>
                        </div>
                        <div class="col-md-2">   
                        <button type="submit" class="btn btn-danger btn-md " name="deleteproductcart" data-toggle="modal" data-target="#myModal">Delete</button>
                        </div>
                    </div>
                </div>    
                <div class="box3">
                    <form action="" method="post">
                        <?php 
                        //Sum of total price of product cart
                            $sql = mysqli_query($connect,"SELECT sum(total) FROM productcart");
                            $fetch_row = mysqli_fetch_assoc($sql);
                        ?>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="number" min="0" value="<?php echo $fetch_row['sum(total)'];?>" class="form-control" name="subtotal" id="subTotal" placeholder="Sub total">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="number" min="0"  class="form-control" id="paid" value="<?php if(empty($_POST['paidamount'])){ } else{echo $_SESSION['paidamount'];} ?>" name="paidamount" placeholder="Paid Amount" required>
                                </div>
                            </div>
                                <?php 
                                //adding order payment, date data in a table
                                    if(isset($_POST['buy'])){
                                        $subtotal = mysqli_real_escape_string($connect,$_POST['subtotal']);
                                        $balance = $paidamount- $fetch_row['sum(total)']; 
                                        mysqli_query($connect,"INSERT INTO orderProduct (date_time,subTotal,paid,balance)VALUES(CURRENT_TIMESTAMP,'$subtotal','$paidamount','$balance')");
                                        $lastid = mysqli_insert_id($connect);
                                        echo '<script>alert("Order completed")</script>';
                                        //$updatequantity = $_SESSION['availableQuantity']-$_SESSION['newquantity'];
                                        //mysqli_query($connect,"UPDATE product SET quantity='$updatequantity' WHERE barcode='$upproductquantity'");
                                    }
                                ?>
                            <div class="col">
                                <div class="form-group">
                                    <input type="number" min="0"  class="form-control" value="<?php echo $balance;?>" name="balance" id="Balance" placeholder="Balance">
                                </div>
                            </div>
                            
                            <div class="col edit_btn">
                                <button type="submit" class="btn btn-success" name="buy">Buy</button>
                                <a href="invoice.php?id=<?php echo $lastid;?>" target="_blank">Invoice</a>
                                <button type="submit"  class="btn btn-danger btn-sm clear " name="clear">Clear Cart</button>
                            </div>
                        </div>
                    </form>
                </div>     
            </div>
            <!-- Bootstrap modal -->
            <div class="modal fade" id="myModal">
            <div class="modal-dialog">
            <div class="modal-content">
                                    
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><img src="image/shop.png" alt="Shop" width="100px" height="100px">Delete Product From Cart</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                                    
            <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" action="">
                                            
                        <div class="form-group">
                            <label for="productCartID">Enter Product Cart ID to delete</label>
                            <input type="number" class="form-control" placeholder="Enter Product Cart ID" id="productCartID" name="productCartID" required>
                        </div>
                        <button type="submit" name="deleteproductcart" class="btn btn-danger float-right">Delete</button>
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