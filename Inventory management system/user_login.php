<?php 
    require "database.php";
    //sign up code for user
    if(isset($_POST['signup'])){
        //get user provided information
        $name = mysqli_real_escape_string($connect,$_POST['name']);
        $email = mysqli_real_escape_string($connect,$_POST['email']);
        $number = mysqli_real_escape_string($connect,$_POST['number']);
        $password = mysqli_real_escape_string($connect,$_POST['password']);
        
        
        if(!empty($name) && !empty($email) && !empty($number) && !empty($password) && !empty($_FILES['image']['name'])){
            $user_check_query = "SELECT * FROM `user` WHERE email='$email' OR phoneNumber='$number' LIMIT 1";
            $result = mysqli_query($connect, $user_check_query);
            $user = mysqli_fetch_assoc($result);
            //check user email and phone number
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
                //getting image
                $file_type = $_FILES['image']['type']; 

                $allowed = array("image/jpeg", "image/jpg", "image/png");
                if(!in_array($file_type, $allowed)) {
                  echo '<script>alert("Only jpg, jpeg, and png files are allowed.")</script>';
                }
                else{
                    //store image
                    move_uploaded_file($_FILES['image']['tmp_name'], "userphoto/".$_FILES['image']['name']);
                    $img="userphoto/".$_FILES['image']['name'];
                    //insert user data in a table
                    $insertUserDataQuery = "INSERT INTO user (name, email, phoneNumber, password,image) VALUES ('$name', '$email', '$number', '$encryptedpassword', '$img') ";
                    $result = mysqli_query($connect,$insertUserDataQuery);
                    if($result){
                        //redirecting into the page
                        header('location: user_login.php');
                    }
                    else{
                        echo '<script>alert("Please enter valid information")</script>';
                    }
                }
            }
          
        }
    }
    //sign in code for the user in to system
    if(isset($_POST['signin'])){
        $username = mysqli_real_escape_string($connect,$_POST['username']);
        $userpassword = mysqli_real_escape_string($connect,$_POST['userpassword']);
        
        if(!empty($username) && !empty($userpassword)){    
            $userpassword = md5($userpassword);
            //matching user name and password
            $query = "SELECT * FROM user WHERE name='$username' AND password='$userpassword'";
            $result = mysqli_query($connect,$query);
            if(mysqli_num_rows($result) > 0){
                $_SESSION['name']=$username;
                header('location: user_menu.php');   
            }
            else{
                echo '<script>alert("Your information is incorrect")</script>';
            }
            
        }
    }
    //if user forgot password and want to reset
    if(isset($_POST['reset'])){
        $email = mysqli_real_escape_string($connect,$_POST['email']);
        $password = mysqli_real_escape_string($connect,$_POST['password']);
        if(!empty($email) && !empty($password)){
            $password = md5($password);
            mysqli_query($connect, "UPDATE user SET password='$password' WHERE email = '$email' ");

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
<body id="userLogin">
    <div class="container">
        <div class="text-center">
            <a href="index.php"><img src="image/shop.png" alt="logo"></a>
            <h1 id="userLogInTxt">Welcome To Our Shop</h1>
        </div>
        <div class="login-form">
            <form action="user_login.php" method="POST" class="needs-validation" novalidate> 
                <div class="form-group">
        	        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="fa fa-user"></span>
                            </span>                    
                        </div>
                        <input type="text" class="form-control" name="username" placeholder="Username" required="required">				
                    </div>
                </div>
		        <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </span>                    
                        </div>
                        <input type="password" class="form-control" name="userpassword" placeholder="Password" required="required">				
                    </div>
                </div>        
                <div class="form-group">
                    <button type="submit" name="signin" class="btn btn-primary login-btn btn-block">Sign in</button>
                </div>
                <div class="clearfix">
                    <!-- <label class="float-left form-check-label"><input type="checkbox"> Remember me</label> -->
                    <a href="" class="float-right" data-toggle="modal" data-target="#myModal2">Forgot Password?</a>
                </div>
            </form>
            <p class="text-center text-muted small">Don't have an account? <a data-toggle="modal" data-target="#myModal" href="">Sign up here!</a></p>
        </div>
        <!-- bootstrap modal -->
        <div class="modal fade" id="myModal2">
        <div class="modal-dialog">
        <div class="modal-content">
                        
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title"><img src="image/shop.png" alt="Shop">Reset Password</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
                        
        <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="">
                                
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" placeholder="Enter your email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" class="form-control" placeholder="Enter your password" id="pwd" name="password" required> 
                    </div>
                    <button type="submit" name="reset" class="btn btn-success float-right">Reset</button>
                </form> 
            </div>
            </div>
            </div>
            </div>
            <div class="modal fade" id="myModal">
            <div class="modal-dialog">
            <div class="modal-content">
                  
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><img src="image/shop.png" alt="Shop">Sign Up</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                  
            <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" action="" class="needs-validation" novalidate enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Enter your name" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" placeholder="Enter your email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="number">Phone Number</label>
                            <input type="number" class="form-control" placeholder="Enter your phone number" id="number" name="number" required>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password</label>
                            <input type="password" class="form-control" placeholder="Enter your password" id="pwd" name="password" required> 
                        </div>
                        <div class="form-group">
                            <label for="image">Image:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <input type="file"  placeholder="Choose your Image" id="image" name="image" required>
                        </div>
                        <button type="submit" name="signup" class="btn btn-success float-right">Sign Up</button>
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