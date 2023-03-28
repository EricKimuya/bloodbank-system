<?php
include('./header.php');
include('db_connect.php');
session_start();
error_reporting(0);
$id = $_SESSION['login_id'];
$sql = "SELECT * FROM donors WHERE user_id=$id";
$result = mysqli_query($conn,$sql);
$donor = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>donors_info page</title>
    <style>
        body {
            background-color: white;
        }

        .main-container {
            display: flex;
            flex-direction: row;

            height: 100vh;
            width: 100vw;
            justify-content: center;
            align-items: center;
        }

        .profile {
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            border-radius: .4rem;
            padding: 4rem;
            background-color: whitesmoke;
            margin-top: 3rem;
            width: 70%;
            height: 70%;

        }
        .name {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: black;
        }
        .table{
            padding:1rem;
            width: 100%;
        }
        .table tr{
            padding: 1rem;
        }

    </style>
    <script src="https://kit.fontawesome.com/7428fd048c.js" crossorigin="anonymous"></script>
</head>

<body>

<div class="main-container">
    <div class="profile position-relative">
        <div class="name">
            <h4>PROFILE</h4>
            <!-- <span>
                <button class="btn btn-info p-4">Edit info</button>
            </span> -->
        </div>
        <hr>
        <div class="myinfo position-relative">
            <div class="row">
                <div class="form-group col">
                    <label for="">Name</label>
                    <div>
                        <strong><?=$donor['name']?></strong>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="">Address</label>
                    <div>
                        <strong><?=$donor['address']?></strong>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="form-group col">
                    <label for="">Contact </label>
                    <div>
                        <strong><?=$donor['contact']?></strong>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="">Email</label>
                    <div>
                        <strong><?=$donor['email']?></strong>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="form-group col">
                    <label for="">Blood Group </label>
                    <div>
                        <strong class="text-uppercase"><?=$donor['blood_group']?></strong>
                    </div>
                </div>
            </div>


        </div>
        <div class="position-absolute bottom-0 end-0 start-0" onclick="window.history.back()">
            <button class="btn btn-danger">Exit</button>
        </div>
    </div>
</div>
</body>

</html>