<?php

include("db_connect.php");
error_reporting();
session_start();
if (isset($_POST['submit'])) {
    $subject = $_POST['subject'];
    $contact = $_POST['contact'];
    $message = $_POST['message'];


    $sql = "SELECT id FROM messages WHERE subject='$subject' AND message='$message'";
    die($conn);
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo ("<script>
    alert('The message has already been submited before')
    </script>");
        return;
    }
    else
    {
        $sql = "INSERT into messages (subject, contact,message)
        VALUES('$subject', '$contact', '$message')";
        $result = mysqli_query($conn, $sql);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact us page.</title>
</head>
<?php
include('./header.php');

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
            overflow: hidden;
        }

        .contact{
            background-color: #dc3545;
            height: 100vh;
            color: white;
        }

        .form {
            margin-top: 5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .form-group {
            margin-left: 1rem;
            margin-top: 1rem;

        }

        .form-group .form-control {
            width: 500px;

        }

        .response{
            box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px;
            border-radius: 0.4rem;
        }

        .responses{
            max-height: 100vh;
            overflow-y: auto;
            padding-bottom: 10rem;
        }


    </style>
    <script src="https://kit.fontawesome.com/7428fd048c.js" crossorigin="anonymous"></script>
</head>

<body>
<div class=" row p-3 w-100">
    <div class="col-4 contact">
        <div class="form">
            <h3 class="text-center text-uppercase pt-5 mb-3">Contact Us</h3>
            <div >
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" class="form-control" id="subject" name="subject">
                </div>
                <div class="form-group">
                    <label for="info">Phone Number</label>
                    <input type="text" class="form-control" id="contact" name="contact">
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" rows="5" id="message" name="message"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-light w-100" name="submit" onclick="submitMessage()">
                        Submit
                    </button>
                </div>

            </div>
        </div>
    </div>
    <div class="col responses">
        <h3 class="text-center text-uppercase pt-5 mb-3 ">Responses</h3>
        <div class="d-flex flex-column">
        </div>
    </div>
</div>

<script>
    function submitMessage() {
        const postObj ={
            action:'contact',
            subject:$("#subject").val(),
            contact:$("#contact").val(),
            message:$("#message").val(),
        }

        for(let key in postObj){
            if(!postObj[key]){
                alert(key+" is required")
                return;
            }
        }

        $.post('./donor/action.php',postObj,function (data,status) {
            if(data == '1'){
                alert("Message sent successfully");
                fetchData();
            }
            else{
                alert("Failed to send message please try again later")
            }
        })
    }

    function fetchData(){
        $.post('./donor/action.php',{action:'get-messages'},function (data,status) {
            $('.responses>.flex-column').html('');
            data.forEach(response=>{
                $('.responses>.flex-column').append(`
                              <div class="response py-3 px-2 my-3">
                <div class="form-group">
                    <label for="" ><strong>Subject</strong></label>
                    <div>
                        ${response.subject}
                    </div>
                </div>
                <div class="form-group">
                    <label for="" ><strong>Message</strong></label>
                    <div class="text-muted">
                        ${response.message}
                    </div>
                </div>
                <div class="form-group">
                    <label for="" ><strong>Admin Response</strong></label>
                    <div class="text-muted">
                        <span class="badge badge-danger ${response.response?'d-none':'d-inline'}">No response yet</span>
                        <span class="${response.response?'d-block':'d-none'}">${response.response}</span>
                    </div>
                </div>
            </div>
                `)
            })
        },"json")
    }

    $(document).ready(function () {
        fetchData();
    })
</script>

</body>
</html>