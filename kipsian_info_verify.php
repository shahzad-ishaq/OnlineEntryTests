<?php
session_start();
$_SESSION["post_check"] = "yes_post_$";
include('dbconnection.php');

if (isset($_POST['cnic'])) {
    $cnic = $_POST['cnic'];
    $cnic = addslashes($cnic);
    $sql = $link->query("SELECT ad.* FROM admissions_ec ad WHERE ad.cnic = '$cnic' ORDER BY ad.id DESC LIMIT 1");
if ($sql->num_rows > 0) {
    $result = mysqli_fetch_array($sql);

}
}
?>


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
        <h3 style="font-size: 30px;font-weight: bolder">Verify Your Personal Information</h3>
        <h5 class="heading-down">STUDENT ADMISSION FORM</h5>
    </div>
</nav>
</div>
</div>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-9">
<div class="text-left">
    <div class="container main-form">
                <div style="padding-top:100px" >
                        <form id="myform" method="post" action="sms_verify.php" class="form-horizontal" role="form">
                            <div class="form-group col-md-12">
                                <div class="form-group col-sm-6 section">
                                    <label for="exampleInputPassword1">Student Full Name</label>
                                    <input class="form-control" type="text" maxlength="50" name="student_name" <?php if(isset($result['student_name'])) echo 'readonly';?>
                                           id="student_name" value="<?php if(isset($result['student_name'])) echo $result['student_name'];?>"
                                           style="text-transform: uppercase" autocomplete="off" onkeydown="return ( event.ctrlKey || event.altKey
			                    || (64<event.keyCode &amp;&amp; event.keyCode<91)
			                    || (96<event.keyCode &amp;&amp; event.keyCode<123)
								|| (event.keyCode==8) || (event.keyCode==9)
			                    || (event.keyCode==32) )" aria-required="true" aria-invalid="false"
                                           placeholder="Full Name" required>
                                </div>
                                <div class="form-group col-sm-6 section">
                                    <label for="exampleInputPassword1">Mobile Number</label>
                                    <input type="text" class="form-control" name="cellphone_number" <?php if(isset($result['cellphone'])) echo 'readonly';?>
                                           id="cellphone_number" value="<?php if(isset($result['cellphone'])) echo $result['cellphone'];?>"
                                           placeholder="Cellphone Number* - (92)333-1234567" required
                                           onkeypress='return validatenumber(event);'>
                                </div>
                            </div>
                            <div class="form-group col-md-12 section">
                                <div class="form-group col-sm-6 section">
                                    <label for="exampleInputPassword1">Email Address</label>
                                    <input class="form-control" type="email" name="email_address" id="email_address" <?php if(isset($result['email']) && !empty($result['email'])) echo 'readonly';?>
                                           value="<?php if(isset($result['email'])) echo $result['email'];?>" placeholder="Email Address" required>
                                </div>
                                <div class="form-group col-sm-6 section">
                                    <label for="exampleInputPassword1">Student CNIC/B-form</label>
                                    <input type="text" class="form-control" name="cnic" id="cnic" value="<?php if(isset($result['cnic'])) echo $result['cnic'];?>"
                                           placeholder="CNIC/ B-form* - (36103-1234565-1)" required <?php if(isset($result['cnic'])) echo 'readonly';?>
                                           onkeypress='return validatenumber(event);'>
                                </div>
                            </div>
                            <input type="hidden" name="institute_type" id="institute_type" value="3">
							<input type="hidden" name="campus_type_id" id="campus_type_id" value="2">

                            <div class="form-group col-sm-12 btn-div">
                                <button type="submit" class="btn btn-primary btn-lg" >NEXT </button>
                                <!-- <a id="btn-login" href="#" class="btn btn-primary">NEXT </a>-->


                            </div>

                 </form>
                </div>
    </div>
</div>
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

