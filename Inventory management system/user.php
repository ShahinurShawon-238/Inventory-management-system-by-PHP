<?php 
    require "database.php";
    // register user by admin
    if(isset($_POST['RegisterUser'])){
        $name = mysqli_real_escape_string($connect,$_POST['name']);
        $email = mysqli_real_escape_string($connect,$_POST['email']);
        $number = mysqli_real_escape_string($connect,$_POST['number']);
        $password = mysqli_real_escape_string($connect,$_POST['password']);
        
        
        if(!empty($name) && !empty($email) && !empty($number) && !empty($password) && !empty($_FILES['image']['name'])){
            $user_check_query = "SELECT * FROM `user` WHERE email='$email' OR phoneNumber='$number' LIMIT 1";
            $result = mysqli_query($connect, $user_check_query);
            $user = mysqli_fetch_assoc($result);
            //check the user email and phone number from database
  
            if ($user) { // if user exists
                if ($user['email'] == $email) {
                    echo '<script>alert("Email is already used")</script>';
                }

                if ($user['phoneNumber'] == $number) {
                    echo '<script>alert("Phone number is already used")</script>';
                }
            }
            else{
                
                $encryptedpassword = md5($password);//encrypt the password
                //get user image and data and store in database 
                $file_type = $_FILES['image']['type']; 
                $allowed = array("image/jpeg", "image/jpg", "image/png");
                if(!in_array($file_type, $allowed)) {
                  echo '<script>alert("Only jpg, jpeg, and png files are allowed.")</script>';
                }
                else{
                    //moving image in a local folder under the project folder
                    move_uploaded_file($_FILES['image']['tmp_name'], "userphoto/".$_FILES['image']['name']);
                    $img="userphoto/".$_FILES['image']['name'];
                    //insert user data in user table
                    $insertUserDataQuery = "INSERT INTO user (name, email, phoneNumber, password,image) VALUES ('$name', '$email', '$number', '$encryptedpassword', '$img') ";
                    $result = mysqli_query($connect,$insertUserDataQuery);
                    if($result){
                        header('location: user.php');
                    }
                    else{
                        echo '<script>alert("Please enter valid information")</script>';
                    }
                }
                
            }
          
        }
    }
    //delete user from the system
    if(isset($_POST['deleteuser'])){
        $userID = mysqli_real_escape_string($connect,$_POST['userID']);
        if(!empty($userID)){
            mysqli_query($connect, "DELETE FROM user WHERE id='$userID'");

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
                <h1 class="menuTxt">Our Shop-User</h1>
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
                        <li class="nav-item ">
                            <a class="nav-link" href="product.php">Product</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="point_of_sell.php">POS</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="user.php">User<span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container adminmenuRowContainer userregistercontainer">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form method="POST" action="user.php" class="needs-validation userregisterform" novalidate enctype="multipart/form-data">                        
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter user name" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter user email" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Enter user phone number" name="number" id="number" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Enter user password" name="password" id="password" required> 
                            </div>
                            <div class="form-group row" >
                                <label for="image" class="col-sm-2 col-form-label">User Image: </label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="image" name="image" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success" name="RegisterUser">Register User</button>
                        </form> 
                    </div>
                    <div class="col-md-2"></div>
                </div>   
                <div class="row row2">
                    <div class="col-md-10">
                        <?php 
                            $showuser = mysqli_query($connect,"SELECT * FROM `user`");
                        ?>
                        <div class="scrollable">
                            <table id="scrollingtable" class="table table-striped table-bordered ">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" >Id</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Number</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <!-- Show registered user in a html table -->
                                    <?php while($row = mysqli_fetch_assoc($showuser)){ ?>
                                    <tr>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['name'];?></td>
                                        <td><img src="<?php echo $row['image'];?>" alt="Photo"></td>
                                        <td><?php echo $row['phoneNumber'];?></td>
                                        <td><?php echo $row['email'];?></td>  
                                    </tr>  
                                    <?php
                                        }
                                    ?>
                                </tbody>                            
                            </table>
                        </div>                                                
                    </div>
                    <div class="col-md-2">
                            <button type="submit" name="deleteuser" data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-md ">Delete</button>    
                    </div>
                    
                </div> 
            </div>
            <!-- bootstrap modal -->
            <div class="modal fade" id="myModal">
            <div class="modal-dialog">
            <div class="modal-content">
                                    
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><img src="image/shop.png" alt="Shop" width="100px" height="100px">Delete User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                                    
            <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" action="">
                                            
                        <div class="form-group">
                            <label for="userID">Enter User ID to delete</label>
                            <input type="number" class="form-control" placeholder="Enter user ID" id="userID" name="userID" required>
                        </div>
                        <button type="submit" name="deleteuser" class="btn btn-danger float-right">Delete</button>
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
