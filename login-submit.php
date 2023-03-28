<?php
session_start();
include './db_connect.php';
if(isset($_POST['username'])){
    $choice = $_POST['choice'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $type =1 ;
    
    if($choice =='admin'){
        $type =1 ;
    }
    elseif($choice == 'donor'){
        $type=2;
    }
    $sql= "select * from users where username ='$username' AND password='$password' AND type=$type";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        $row  =mysqli_fetch_assoc($result);
        $_SESSION['login_id'] = $row['id'];
        $_SESSION["username"] =$row["username"];
        echo "1";
    }
    else{
        echo "0";
    }
    }
   
    



    

