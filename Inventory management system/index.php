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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=PT+Sans:wght@400;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7364b90ec9.js" crossorigin="anonymous"></script>
</head>
<body id="index">
    <div class="container">
        <div class="text-center">
            <a href="index.php"><img src="image/shop.png" alt="logo"></a>
            <h1 class="indexTxt">Welcome To</h1>
        </div>
        
        <!-- <input type="button" class="btn btn-info" value="Let's go"> -->
        <div class="text-center homeButtonDiv" >
            <div id="confirm">
                <div class="message"></div>
                <button class="yes">Admin</button>
                <button class="no">User</button>
            </div>
            <button id="homeButton" type="button" class="btn btn-info text-center"  
                onclick='functionConfirm("Which role are you gonna play???", 
                        function yes() 
                            {location.href="admin-login.php";},
                        function no() 
                            {location.href="user_login.php";});'>
                Let's go&nbsp;<i id="arrowRight" class="fas fa-chevron-right"></i>
            </button>
        </div>
        
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script> 
<script src="js/custom.js" type="text/javascript"></script>  
</body>
</html>