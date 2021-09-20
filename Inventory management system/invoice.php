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
<body>
    <div class="container invoice">
        <div class="invoiceheader">
            <img src="image/shop.png" alt="shop">
            <h1 class="text-center font-weight-bold">Our Shop</h1>
        </div>
        <p class="text-center">-------------------------------------------------------------------------------------------------</p>
        <h2 class="text-center">Invoice</h2>
        <?php 
            $showproductcart = mysqli_query($connect,"SELECT * FROM `productcart`");
                            
        ?>
        <div>
            <table>
                <thead >
                    <tr>
                        <th scope="col">Product Code</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                                    
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($showproductcart)){  $productcart_id=$row['id'];?>
                                            
                    <tr>
                        <!-- show bought product -->
                        <td><?php echo $row['productcode'];?></td>
                        <td><?php echo $row['productname'];?></td>
                        <td><?php echo $row['price'];?></td>  
                        <td><?php echo $row['quantity'];?></td>  
                        <td><?php echo $row['total'];?></td>  
                                            
                    </tr>  
                    <?php
                        }
                    ?>
                </tbody>                            
            </table>
        </div>
        <p class="text-center">-------------------------------------------------------------------------------------------------</p>
        <?php 
        //get id from url which is last id
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                
            }
            $showpayment = mysqli_query($connect, "SELECT * FROM orderproduct WHERE id=$id");
            
        ?>
        <!-- <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-2">
                <h6></h6>
                <h6></h6>
                <h6></h6>
            </div> -->
            <?php while($row = mysqli_fetch_array($showpayment)){ ?>
            <!-- <div class="col-md-6"> -->
            <div class="total float-right">
                <!-- Show payment section -->
                <h6>Subtotal :&nbsp;&nbsp;&nbsp;<?php echo $row['subTotal'];?></h6>
                <h6>Paid :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['paid'];?></h6>
                <h6>Balance :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['balance'];?></h6>
            </div>
                <div class="date">
                    <!-- Authorizer -->
                    <h6>Authorized by:<br> Shahinur Shawon</h6>
                    <h6>Date:<?php echo $row['date_time'];?></h6>
                    
                </div>
                <?php
                    }
                ?>
            <!-- </div>
        </div> -->
        <div class="text-center">
            <button class="btn btn-primary btn-md" onclick="window.print();" name="print" id="print_btn">Print</button>
        </div>

    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>     
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="js/custom.js" type="text/javascript"></script>  
</body>
</html>