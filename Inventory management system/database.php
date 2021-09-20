<?php
//no_expire cache limiter
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    //start session
    session_start();
    //connection with the database
    $connect = mysqli_connect("localhost","root","","inventorymanagementsystem");
    if(mysqli_connect_errno()){
        //printing error if find any
        echo"Failed to connect database: ". mysqli_connect_error();
    }
    $edit_state= false;
?>