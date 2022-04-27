<?php
session_start();
//$session_value = 'false';
//if (!isset($_POST['student_name'])) {
//    exit();
//}
//if (isset($_SESSION['post_check']) && $_SESSION['post_check'] == 'yes_post_$') {
//    $session_value = 'true';
//    $_SESSION['detail_check'] = 'yes_post';
//    $_SESSION['post_check'] = '';
//} else {
//    echo "<h2>Your Browser Session is Expired, Please try again. <a href='/'>Reload Page</a></h2>";
//    exit();
//}
//if (isset($_POST['student_name'])) {
    include("ajax_sms.php");
    include("sendMail.php");

    if (isset($_POST['student_name'])) $student_name = $_POST['student_name'];
    if (isset($_POST['cellphone_number'])) $cellphone_number = $_POST['cellphone_number'];
    if (isset($_POST['email_address'])) $email_address = $_POST['email_address'];
    if (isset($_POST['cnic'])) $cnic = $_POST['cnic'];
    if (isset($_POST['institute_type'])) $institute_type = $_POST['institute_type'];
	if (isset($_POST['campus_type_id'])) $campus_type_id = $_POST['campus_type_id'];
    $rendem_num = sprintf("%06d", mt_rand(1, 999999));
    include('dbconnection.php');
    $strSQL = "insert into online_admissions set
    student_name = UPPER('$student_name'),
    cellphone = '$cellphone_number',
    institute_type = '$institute_type',
    authentication_code = '$rendem_num',
    email = '$email_address',
    cnic = '$cnic',
    campus_type_id= '$campus_type_id'";

    if ($link->query($strSQL) === TRUE) {
        $insert_id = $link->insert_id;
        $message = smsText($rendem_num);
        $mobile = formatMobileNo($cellphone_number);
       /// sendsms($ping->data, $mobile, $message, 'KIPS PREPS');
        $email_massage = "<p>Dear $student_name,</p><br>
						<p>Please use $rendem_num as Verification code for online admission.</p><br><br>
                           Sincerely, <br>
                           KIPS PREPS<br><br><br>
						   <p><i><b>*** This is an automatically generated email. Please do not reply to it. ***</b></i></p>";
        $massage_from = "KIPS PREPS";
        //send_email($email_address,$student_name,$massage_from,$email_massage);
        $receipt_no = $link->insert_id;
        $record_save_message = "<h2>Application Submitted Successfully</h2>";
    } else {
        $record_save_message = "<h2>Error: " . $strSQL . "<br>" . $link->error . "<h2>";
    }


//}

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
        <script type="text/javascript" src="js/jquery.redirect.js"></script>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <style>
        input {
            margin: 0 5px;
            text-align: center;
            font-size: 45px;
            border: none;
            outline: none;
            width: 10%;
            transition: all .2s ease-in-out;
            border-radius: 3px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);

        &
        :focus {
            border-color: purple;
            box-shadow: 0 0 5px purple inset;
        }

    </style>
    <div class="modal fade" id="massage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="model-heading">
                    <h4 class="modal-title text-center  " id="exampleModalLongTitle">Code Verified</h4>

                </div>
                <div class="modal-body text-center">
                    <p id="return_massage"></p>
                    <p>For any assistance call at our UAN : 042111547775.</p>

                    <button type="button" id="close_model" class="btn btn-primary btn-lg modal-btn"  data-dismiss="modal">Close</button>
                    <button type="button" id="sunmitForm" class="btn btn-primary btn-lg modal-btn" style="display: none" data-dismiss="modal">Proceed</button>

                </div>

            </div>
        </div>
    </div>
    <body>
    <div class="row">
        <div class="col-md-2 logo-div">
            <img class="logo-img" src="img/KET.png">
        </div>
        <div class="col-md-9">
            <nav class="navbar navbar-inverse">
                <div class="heading-div col-md-7 col-sm-7">
                    <h3 style="font-size: 30px;font-weight: bolder">Authentication Your Account</h3>
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
                            <div class="col-sm-12 user_name text-left" style="text-transform: uppercase">Dear : <?php
                                if (isset($_POST['student_name'])) echo $student_name = $_POST['student_name'];
                                ?>

                            </div>
                            <div class="col-sm-12"><p>Please confirm your account by entering the authorization code
                                    sent
                                    to <?php if (isset($_POST['email_address'])) echo $email_address = $_POST['email_address']; ?> and <?php if (isset($_POST['cellphone_number'])) echo $cellphone_number = $_POST['cellphone_number']; ?></p>
                            </div>
                        <form id="varify_code">
                               <input type="hidden" id="last_id" name="last_id" value="<?php echo $insert_id ?>">
                                <input type="hidden" name="student_name" id="student_name"
                                       value="<?php if (isset($_POST['student_name'])) echo $student_name = $_POST['student_name']; ?>">
                                <input type="hidden" name="cellphone_number" id="cellphone_number"
                                       value="<?php if (isset($_POST['cellphone_number'])) echo $cellphone_number = $_POST['cellphone_number']; ?>">
                                <input type="hidden" name="email_address"
                                       value="<?php if (isset($_POST['email_address'])) echo $email_address = $_POST['email_address']; ?>">
                                <input type="hidden" name="cnic"
                                       value="<?php if (isset($_POST['cnic'])) echo $cnic = $_POST['cnic']; ?>">
                                <div class="col-md-12">
                                    <div class="form-group col-sm-6">

                                        <input type="text" id="code1" name="code1" maxLength="1" size="1" min="0"
                                               max="9" pattern="[0-9]{1}" required/>
                                        <input type="text" id="code2" name="code2" maxLength="1" size="1" min="0"
                                               max="9" pattern="[0-9]{1}" required/>
                                        <input type="text" id="code3" name="code3" maxLength="1" size="1" min="0"
                                               max="9" pattern="[0-9]{1}" required/>
                                        <input type="text" id="code4" name="code4" maxLength="1" size="1" min="0"
                                               max="9" pattern="[0-9]{1}" required/>
                                        <input type="text" id="code5" name="code5" maxLength="1" size="1" min="0"
                                               max="9" pattern="[0-9]{1}" required/>
                                        <input type="text" id="code6" name="code6" maxLength="1" size="1" min="0"
                                               max="9" pattern="[0-9]{1}" required/>

                                    </div>
                                </div>
                                <div class="col-md-12  bottom_div_sms">
                                    <div class="col-sm-6">
                                        <p>It takes a minute to recieve your code.</p>
                                        Haven't received?<a href="#" id="resend" style="font-weight: bold;" onclick="resend_sms(<?php echo $insert_id ?>)"> Resend new code via SMS?</a></div>

                                </div>
                                <div class="form-group col-sm-12 btn-div">
                                    <button type="submit"  class="btn btn-primary btn-lg ">VERIFY</button>
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
        $(function () {
            'use strict';
            var body = $('body');

            function goToNextInput(e) {
                var key = e.which,
                    t = $(e.target),
                    sib = t.next('input');

                if (key != 9 && (key < 48 || key > 57) && (key < 96 && key > 105)) {
                    e.preventDefault();
                    return false;
                }

                if (key === 9) {
                    return true;
                }

                if (!sib || !sib.length) {
                    sib = body.find('input').eq(0);
                }
                sib.select().focus();
            }

            function onKeyDown(e) {
                var key = e.which;

                if (key === 9 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105)) {
                    return true;
                }

                e.preventDefault();
                return false;
            }

            function onFocus(e) {
                $(e.target).select();
            }

            body.on('keyup', 'input', goToNextInput);
            body.on('keydown', 'input', onKeyDown);
            body.on('click', 'input', onFocus);
        });

        $("#varify_code").submit(function (event) {
            var ajaxRequest;
            event.preventDefault();
            var values = $(this).serialize();
            $.ajax({
                url: "sms_code_verify.php",
                type: "post",
                data: values,
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data == false) {
                        $('#return_massage').html('OTP Verification Failed.');
                        $("#close_model").show();
                        $('#massage').modal('show');
                        $("#sunmitForm").hide();
                        ///console.log("here");
                    } else {
                        $('#return_massage').html('OTP Verified, kindly proceed.');
                        $("#close_model").hide();
                        $("#sunmitForm").show();
                        $('#massage').modal('show');
                        let id = data.id;
                        ///console.log(data);

                        /////window.location = 'detail_inform.php?id=' + id
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

        });
        $("#sunmitForm").click( function (event){
            let id=$('#last_id').val();
            let student_name=$('#student_name').val();
           $.redirect('detail_inform.php',{
               id: id,
               student_name:student_name
           });
       });
/////////////////////////////// resend sms /////////////////////////////

        function resend_sms(id) {
            var last_id = id;
            var cellphone_number =  $('#cellphone_number').val();

            if (($.isNumeric(parseInt(last_id)))) {
                $.post(
                    './sms_code_resend.php',
                    {
                        last_id:last_id,
                        cellphone_number:cellphone_number
                    },
                    function (data) {
                        $('#return_massage').html('OTP Code Resent.');
                        $('#massage').modal('show');
                        $("#resend").hide();
                       // var jsonObj = JSON.parse(data);

                    }
                );
            }
            else {

            }


        }



    </script>

<?php
?>