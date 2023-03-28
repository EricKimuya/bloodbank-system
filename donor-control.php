<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>donor</title>
    <style>
        * {
            margin: 0;
        }

        body {
            background-color: white;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #dc3545;
            color: white;

        }.container{
            width: 800px;
            display: flex;
            flex-direction: column;
            padding: 1rem 2.5rem 4rem 2.5rem;
            
            
            
        }

        .link{
            padding: 3rem 0;
            text-align: center;
            margin-bottom: 1rem;
            cursor: pointer;
            font-size: 25px;
            border: 1px solid white;
        }

        .link:hover{
           transform: scale(1.03);
        }

        h1{
            text-align: center;
            margin-bottom: 3rem;
        }
       

    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome Donor to Our Platform</h1>
        <div class="link" onclick="window.location.assign('donor_info.php')">
            <span>My profile</span>
        </div>
        <div class="link" onclick="window.location.assign('contact.php')">
            <span>Contact Us</span>
        </div>

        <div class="link" onclick="window.location.assign('login.php')">
            <span>Logout</span>
        </div>

    </div>
</body>

</html>