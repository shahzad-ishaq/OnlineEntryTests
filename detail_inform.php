<?php
session_start();

if (isset($_SESSION['detail_check']) && $_SESSION['detail_check'] == 'yes_post_$') {
    $session_value = 'true';
    $_SESSION['process_check'] = 'yes_post_$';
    $_SESSION['detail_check'] = '';
if(isset($_POST["id"])) {
    $id = $_POST["id"];
    $student_name = $_POST["student_name"];
}else{
    header("Location: https://kips.edu.pk");
      exit();
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
        <script type="text/javascript" src="js/custom.js"></script>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    </head>
    <body>
    <div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="model-heading">
                    <h4 class="modal-title text-center  " id="exampleModalLongTitle">Successful</h4>

                </div>
                <div class="modal-body text-center">
                    <p><strong class="text-black">Congratulations! </strong>You have successfully submitted </p>
                    <p>the admission form.Please proceed for fee payment..</p>

                    <button type="button" class="btn btn-primary btn-lg modal-btn" onclick="submit_form()"  data-dismiss="modal">Proceed</button>

                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 logo-div">
            <img class="logo-img" src="img/KET.png">
        </div>
        <div class="col-md-9">
            <nav class="navbar navbar-inverse">
                <div class="heading-div col-md-7 col-sm-7">
                    <h3 style="font-size: 30px;font-weight: bolder" id="welcome">Hello <?=$student_name?>, Select your mode of study</h3>
                    <h3 style="font-size: 30px;font-weight: bolder;display: none;" id="c_campus">Choose Your Campus</h3>
                    <h3 style="font-size: 30px;font-weight: bolder;display: none;" id="d_field">Select Your Desired Field</h3>
                    <h3 style="font-size: 30px;font-weight: bolder;display: none;" id="c_field">Select Your Course</h3>
                    <h3 style="font-size: 30px;font-weight: bolder;display: none;" id="s_field">Select Your Session</h3>
                    <h3 style="font-size: 30px;font-weight: bolder;display: none;" id="a_field">Select Your Group</h3>
                    <h3 style="font-size: 30px;font-weight: bolder;display: none;" id="ad_field">Academic Information</h3>
                    <h5 class="heading-down">STUDENT ADMISSION FORM</h5>
                </div>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-9">
            <div class="container-fluid" id="grad1">
                <div class="row">
                    <div class="">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-12 mx-0">
                                   <!-- <form id="msform">-->
                                    <form id="msform" class="form-horizontal" role="form" action="process_voucher.php" method="post">
                                        <input type="hidden" name="info_id" id="info_id" value="<?=$id?>">
                                        <!-- progressbar -->
                                        <ul id="progressbar">
                                            <li class="active" id="one"></li>
                                            <li id="two"></li>
                                            <li id="three"></li>
                                            <li id="four"></li>
                                            <li id="five"></li>
                                            <li id="six"></li>
                                            <li id="seven"></li>
                                        </ul> <!-- fieldsets -->
                                        <fieldset>
                                            <div class="form-card">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="text-center">
                                                            <div class="container main-form">
                                                                <a class="link" >
                                                                    <div class="online">

                                                                        <img src="img/online.png" href="#" onclick="get_campuses(1)">
                                                                        <h5 class="kipsian-btn">Online</h5>
                                                                    </div>
                                                                </a>
                                                                <a class="link" onclick="get_campuses(3)">
                                                                    <div class="on-campus">
                                                                        <img src="img/on-campus.png" >
                                                                        <h5 >On Campus</h5>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="button" name="next" class="next action-button first_tab" onclick="nextWelcome();" value="Next Step" disabled />
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-card">
                                                <div class="form-group col-md-12 section">
                                                 <div class="form-group col-sm-4 section" id="city">
                                                        <label for="exampleInputPassword1">City*</label>
                                                        <select class="form-control" id="city_id" name="city_id" onchange="get_campuses(2)"
                                                                required>
                                                            <option value=""> <?php echo "Select City"; ?> </option>
                                                            <?php
                                                            include('dbconnection.php');
                                                            $sql = "SELECT city.city_name as city_name,city.id as city_id	
                                                                    FROM cities city inner join campuses cam ON cam.city_id = city.id 	
                                                                    where city.status = 'Active' AND cam.type_id = 2 GROUP BY city.id 
                                                                    ORDER BY city.city_name ASC";

                                                            $query = mysqli_query($link, $sql);

                                                            while ($result = mysqli_fetch_array($query)) {
                                                                $city_id = $result["city_id"];
                                                                $city_name = $result["city_name"];
                                                                ?>
                                                                <option value="<?php echo $city_id; ?>"> <?php echo $city_name; ?> </option>


                                                            <?php }

                                                            $link->close();
                                                            ?>

                                                        </select>
                                                        <i class="arrow double"></i>
                                                    </div>
                                                <div class="form-group col-sm-4 section" id="campus">
                                                    <label>Campuses</label>
                                                    <select class="form-control" id="campuses" name="campuses"
                                                            required disabled>
                                                        <option value="">Select Campus*</option>
                                                    </select>
                                                    <i class="arrow double"></i>
                                                </div>
                                                </div>
                                            </div>
                                            <input type="button" name="previous" class="previous action-button-previous" onclick="backWelcome();" value="Previous" /> <input type="button" name="next" class="next action-button" onclick="nextCampus();" value="Next Step" />
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-card">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="text-center">
                                                            <div class="container main-form">
                                                                <a class="link" >
                                                                    <div class="grp_engr">
                                                                        <label>
                                                                            <input type="radio" name="class_field" value="1" onchange="get_class()">
                                                                            <img src="img/engineering.png" href="#">
                                                                            <h5 class="kipsian-btn">Engineering </h5>
                                                                        </label>

                                                                    </div>
                                                                </a>
                                                                <a class="link">
                                                                    <div class="grp_medical">
                                                                        <label>
                                                                            <input type="radio" name="class_field" value="2" onchange="get_class()">
                                                                            <img src="img/medical.png" >
                                                                            <h5 >Medical</h5>
                                                                        </label>

                                                                    </div>
                                                                </a>
                                                                <a class="link">
                                                                    <div class="grp_other">
                                                                        <label>
                                                                            <input type="radio" name="class_field" value="3" onchange="get_class()">
                                                                            <img src="img/other.png" >
                                                                            <h5 >Other</h5>
                                                                        </label>

                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" onclick="nextWelcome();" />
                                            <input type="button" id="classe_button" disabled name="next" class="next action-button" onclick="nextGroup();" value="Next Step" />
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-card">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="text-center">
                                                            <div class="container main-form">
                                                                <div id="classes"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="button" name="previous" class="previous action-button-previous" onclick="nextCampus();" value="Previous" />
                                            <input type="button" name="next" id="check_group" disabled class="next action-button" onclick="nextCourse();" value="Next Step" />
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-card">
                                                <div class="col-sm-12">
                                                <div class="form-group col-sm-4">
                                                    <label>Session</label>

                                                    <select class="form-control" id="sessions" name="sessions" onchange="get_group()"
                                                            required disabled>
                                                        <option value="">Select a Session</option>
                                                    </select>
                                                </div>
                                                </div>
                                            </div>
                                            <input type="button" name="previous" class="previous action-button-previous" onclick="nextGroup();" value="Previous" /> <input type="button" name="next" class="next action-button" onclick="nextSession();" value="Next Step" />
                                        </fieldset>

                                        <fieldset>
                                            <div class="form-card">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="text-center">
                                                            <div class="container main-form">
                                                                <div id="groups"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="next" class="next action-button" onclick="nextCourse();" value="Next Step" />
                                        </fieldset>

                                        <fieldset>
                                            <div class="form-card">
                                                <div class="col-sm-12">
                                                <div class="form-group col-sm-4 section">
                                                    <label>Your Last Class</label>
                                                    <select class="form-control" id="class_passed" name="class_passed" required>
                                                        <option value="">Select Last Class</option>
                                                        <option value="11th">1st Year</option>
                                                        <option value="12th">2nd Year</option>
                                                        <option value="O-Level">O-Level</option>
                                                    </select>
                                                    <i class="arrow double"></i>
                                                </div>
                                                    <div class="form-group col-sm-4 section">
                                                        <label>Last Class Status</label>
                                                        <select class="form-control" id="class_status" name="class_status" required>
                                                            <option value="">Select Last Class Status</option>
                                                            <option value="Pass">Pass</option>
                                                            <option value="ongoing">On Going</option>
                                                        </select>
                                                        <i class="arrow double"></i>

                                                    </div>

                                                </div>
                                                <div class="col-sm-12">
                                                <div class="form-group col-sm-4 section">
                                                    <label>Board</label>


                                                    <select class="form-control" id="examination_board" name="examination_board">

                                                        <option value="">Select Examination Board, If Applicable</option>
                                                        <?php
                                                        include('dbconnection.php');
                                                        $list_board_sql = "SELECT id,name as board_name FROM list_boards";
                                                        $board_query = mysqli_query($link, $list_board_sql);
                                                        while ($board = mysqli_fetch_array($board_query)) { ?>
                                                            <option value="<?php echo $board['id']; ?>"><?= $board['board_name'] ?></option>
                                                            <?php
                                                        }
                                                        $link->close();
                                                        ?>


                                                    </select>
                                                    <i class="arrow double"></i>

                                                </div>
                                                    <div class="form-group col-sm-4 section">
                                                        <label>Roll #</label>
                                                        <input type="text" name="roll_number" id="roll_number" class="form-control"
                                                               placeholder="Roll Number" onkeypress='return validatenumber(event);'>
                                                        <span class="field-icon"><i class="fa fa-university"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                <div class="form-group col-sm-4 section">
                                                    <label>Obtained Marks</label>
                                                    <input type="text" name="marks_obtained" id="marks_obtained" class="form-control"
                                                           placeholder="Marks Obtained" maxlength="4"
                                                           onkeypress='return validatenumber(event);'>
                                                    <span class="field-icon"><i class="fa fa-university"></i></span>

                                                </div>
                                                </div>
                                            </div>
                                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" onclick="nextCourse();" />
                                            <input type="button" name="make_payment" class="action-button" onclick="check_form()" value="Confirm" />

                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>
    </body>
    </html>
    <?php
} else {
    echo "<h2>Your Browser Session is Expired, Please try again. <a href='/'>Reload Page</a></h2>";
    exit();
}
    ?>
    <script>
        function check_form() {
            if ($('#msform').valid()) {
                $('#message').modal('show');
               /* setTimeout(function () {
                    window.location = 'index.php';
                }, 9000);*/
            }
        }
        function submit_form(){
            $("#msform").submit();
        }

        $(function () {
            'use strict';
            var body = $('body');
            function goToNextInput(e) {
                var key = e.which,
                    t = $(e.target),
                    sib = t.next('input');

                if (key != 9 && (key < 48 || key > 57) && (key < 96 && key > 105) || event.key === "Backspace") {
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

                if (key === 9 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || event.key === "Backspace") {
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
        })
    </script>

<?php
?>