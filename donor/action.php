<?php
session_start();
include  '../db_connect.php';

if(isset($_POST['action'])){
    $action = $_POST['action'];

    if($action == 'REGISTER'){
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $name = $_POST['name'];

        $sql = "SELECT id FROM users WHERE username='$username'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            echo "Username is already taken";
            return;
        }
        $sql = "INSERT INTO users(username,password,type,name) VALUES('$username','$password',2,'$name')";
        mysqli_query($conn,$sql);

        $sql = "SELECT id FROM users WHERE username='$username'";
        $result = mysqli_query($conn,$sql);
        $result = mysqli_fetch_assoc($result);
        $id = $result['id'];

        $blood_group = $_POST['blood_group'];
        $address = $_POST['address'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'];

        $sql = "INSERT INTO donors(blood_group,name,address,contact,email,user_id) VALUES('$blood_group','$name','$address','$phone_number','$email',$id)";
        if(mysqli_query($conn,$sql)){
            echo '1';
        }

        echo '';
    }
    else if($action == 'contact'){
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $contact = $_POST['contact'];
        $id = $_SESSION['login_id'];

        $sql = "INSERT INTO messages (subject,message,contact,user_id) VALUES('$subject','$message','$contact',$id)";

        if(mysqli_query($conn,$sql)){
            echo "1";
            return;
        }

        echo "0";
    }
    else if($action == 'get-messages'){
        $id = $_SESSION['login_id'];
        $sql = "SELECT * FROM messages WHERE user_id=$id";

        $result = mysqli_query($conn,$sql);
        $data = [];

        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        echo json_encode($data);
    }
    else if($action == 'get-all-messages'){
        $sql = "SELECT m.*,d.name,d.email FROM messages m JOIN donors d ON d.user_id = m.user_id ";

        $result = mysqli_query($conn,$sql);
        $data = [];

        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        echo json_encode($data);
    }

    else if($action == 'update-response'){
        $id = $_POST['id'];
        $response = $_POST['adminResponse'];

        $sql = "UPDATE messages  SET response='$response' WHERE  id=$id";

        if(mysqli_query($conn,$sql)){
            echo '1';
            return;
        }
        echo '0';
    }
}