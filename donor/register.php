<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <?php include('./header.php'); ?>
    <link rel="stylesheet" href="../assets/css/login.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
<main id="main" class=" bg-danger">
    <div id="login-left" style="background-image: url(../assets/uploads/bloodbg.jpg);">
    </div>

    <div id="login-right" class="bg-danger">
        <div class="w-100">
            <br>
            <br>
            <div class="card col-md-8">
                <div class="card-body">
                    <form id="register-form" >
                        <div class="login px-2">REGISTER</div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" id="address">
                        </div>
                        <div class="row">
                            <div class="form-group col">
                                <label for="">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number">
                            </div>
                            <div class="form-group col">
                                <label for="">Email</label>
                                <input type="text" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Blood Group</label>
                            <input type="text" class="form-control" id="blood_group">
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" placeholder="User name" id="username">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" id="password">
                        </div>
                        
                        <button class="btn-sm btn-block btn-wave col-md-4 btn-primary" name="login-btn">Submit</button>
                    </form>

                    <div class="mt-4">
                        Already have an account? <a href="../login.php">Login here</a> to donate
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<script>

    function handleSubmit(e){
        e.preventDefault();
        let data = {
            name: $("#name").val(),
            username: $("#username").val(),
            phone_number: $("#phone_number").val(),
            address: $("#address").val(),
            email: $("#email").val(),
            blood_group: $("#blood_group").val(),
            password: $("#password").val(),
            action:"REGISTER"
        }

        for(let key in data){
            if(!data[key]){
                alert(key+" is required");
                return;
            }
        }
        $.post('action.php',data,function (data,status) {
            if(data == '1'){
                alert('Registration successful')
                window.location.assign('../login.php')
            }
            else{
                alert(data || 'Registration failed')
            }
        })
    }

    $(document).ready(function() {
        $('#register-form').submit(handleSubmit);
    })
</script>

</body>

</html>