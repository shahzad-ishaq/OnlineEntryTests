<?php
session_start();
$_SESSION["post_check"] = "yes_post_$";?>
<html lang="en">
<head>
    <title>Online Admission Forms</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='fonts/poppins.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">


</head>
<body>
<div class="row">
<div class="col-md-2 logo-div">
    <img class="logo-img" src="img/KET.png">
</div>
<div class="col-md-9">
<nav class="navbar navbar-inverse">
    <div class="heading-div col-md-7 col-sm-7">
        <h3 style="font-size: 30px;font-weight: bolder">Welcome To KIPS</h3>
        <h5 class="heading-down">STUDENT ADMISSION FORM</h5>
    </div>
</nav>
</div>
</div>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-9">
<div class="text-center">
    <div class="container main-form">
        <a class="link" href="kipsian_info.php">
                <div class="kipsian">
<img src="img/kipsian.png" href="#">
                    <h5 class="kipsian-btn">KIPSIAN</h5>
                </div>
        </a>
        <a class="link" href="non_kipsian_info.php">
        <div class="new-kipsian">
            <img src="img/new-kipsian.png" >
            <h5 >NEW KIPSIAN</h5>
        </div>
        </a>
        <h5>If you have studied in KIPS previously,please select the first option.</h5>
    </div>
</div>
        <hr>
        <h5>If you do not wish to apply online,you can always apply at campus within office hours.</h5>
        <ul>
            <li>Visit your desired KIPS campus</li>
            <li>Get admission form and fill it correctly as instructed</li>
            <li>Submit the form along with below mentioned documents</li>
            <li>1 CNIC copy of father/guardian</li>
            <li>2 passport size photograph</li>
            <li>Copy of Matric/O-Levels(or-equivalent) Result card</li>
            <li>Copy of Inter/A-Levels(or-equivalent) Part 1 Result card</li>
            <li>Copy of Student`s B-form/CNIC/Juvenile card</li>
            <li>Submit form with fee at campus</li>
            <li>Collect the fee deposit slip containing session & Student details </li>
        </ul>
</div>
</div>
</body>
</html>
<script>
    function validatenumber(event) {
        var key = window.event ? event.keyCode : event.which;
        if (event.keyCode == 8 || event.keyCode == 46
            || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 9) {
            return true;
        } else if (key < 48 || key > 57) {
            return false;
        } else return true;
    };

    function validatechar() {
        var firstname = document.getElementById("student_name");
        var alpha = /^[a-zA-Z\s-, ]+$/;
        if (firstname.value == "") {
            alert('Please enter Name');
            return false;
        } else if (!firstname.value.match(alpha)) {
            alert('Invalid ');
            return false;
        } else {
            return true;
        }
    }

    $("#cnic").mask('88888-8888888-8');
    $("#cellphone_number").mask('(92) 388-8888888');

       $("#myform").validate({
            rules: {
                student_name: {
                    required: true,
                },
                cellphone_number: {
                    required: true,
                },
            },
            messages: {
                student_name: {
                    required: "Please enter Name",
                },
                cellphone_number: {
                    required: "Please enter Mobile Number",
                },
            },
        });



</script>

