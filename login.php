<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
ob_start();

if (!isset($_SESSION['system'])) {
    $system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
    foreach ($system as $k => $v) {
        $_SESSION['system'][$k] = $v;
    }
}
ob_end_flush();
?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo $_SESSION['system']['name'] ?></title>


    <?php include('./header.php'); ?>
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
<main id="main" class=" bg-danger">
    <div id="login-left" style="background-image: url(assets/uploads/bloodbg.jpg);">
    </div>

    <div id="login-right" class="bg-danger">
        <div class="w-100">
            <h4 class="text-white text-center"><b><?php echo $_SESSION['system']['name'] ?></b></h4>
            <br>
            <br>
            <div class="card col-md-8">
                <div class="card-body">
                    <form id="login-form">
                        <div class="login px-2">LOGIN</div>
                        <div class="header-container">
                            <a href="#" class="active" id="admin" onclick="onChoice('admin')"><span>ADMIN</span></a>
                            <!-- <a href="#" id="manager" onclick="onChoice('manager')"><span>MANAGER</span></a> -->
                            <a href="#" id="donor" onclick="onChoice('donor')"><span>DONOR</span></a>
                        </div>
                        <div class="form-group">
                            <!-- <label for="username" class="control-label">Username</label> -->
                            <input type="text" id="username" name="username" class="form-control" placeholder="username">
                        </div>
                        <div class="form-group">
                            <!-- <label for="password" class="control-label">Password</label> -->
                            <input type="password" id="password" name="password" class="form-control" placeholder="password">
                        </div>
                        <button class="btn-sm btn-block btn-wave col-md-4 btn-primary" name="login-btn">Login</button>
                    </form>

                    <div class="mt-4">
                        Are you new here? <a href="./donor/register.php">Register here</a> to donate
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
    let choice = 'admin'
    function onChoice(ch) {
        choice = ch
        $("#show").css('display', 'block');
        $(".header-container>a").removeClass('active');
        $("#" + ch).addClass("active");
    }

    function handleFormSubmit(e) {
        e.preventDefault();
        let username = $("#username").val()
        let password = $("#password").val()

        if (!username || !password) {
            swal.fire(
                'Login failed',
                'password and or username cannot be empty ',
            )

            return;
        } else {
            $.post('login-submit.php', {
                username,
                password,
                choice
            }, function(data, status) {
                // console.log(data);
                if (data == '1') {
                    if (choice == 'admin') {
                        //redirect to admin
                        window.location.href = "index.php?page=home";
                    } else if (choice == 'donor') {
                        window.location.href = 'donor-control.php'
                    } 
                   
                }
            })
        }
    }

    $(document).ready(function() {
        $('#login-form').submit(handleFormSubmit);
    })
</script>

</html>