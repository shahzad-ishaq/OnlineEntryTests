<?php
session_start();
date_default_timezone_set('Asia/Karachi');
include('dbconnection.php');
if (!isset($_POST['info_id'])) {

   //// header("Location: https://kips.edu.pk"); // Redirect browser
 ////   exit();
}
/*if (isset($_SESSION['post_check']) && $_SESSION['post_check'] == 'yes_post_$') {
    $session_value = 'true';
    $_SESSION['post_check'] = '';
} else {
    echo "<h2>Your Browser Session is Expired, Please try again. <a href='/'>Reload Page</a></h2>";
    exit();
}*/
$receipt_no = '';
$city = '';
$city_id = '';
$campus_code = '';
$class_id = '';
$session_id = '';
$group_id = '';
$student_name = '';
$father_name = '';
$birth_date = '';
$address = '';
$country_id = '';
$province_state_id = '';
$city_name = '';
$post_zip_code = '';
$land_line_number = '';
$class_passed = '';
$roll_number = '';
$examination_board = '';
if (isset($_POST['info_id'])) {
    $info_id=$_POST['info_id'];
    $sql = "SELECT * FROM online_admissions WHERE id = '$info_id'";
    $query = mysqli_query($link, $sql);
    while ($result = mysqli_fetch_row($query)) {
        // print_r($result);

        $student_name = $result[1];
        $cellphone_number = $result[2];
        $email_address = $result[3];
        $cnic = $result[7];
        $gander_id = substr($cnic, -1);
        if (($gander_id % 2) == 0)
            $gender = "FEMALE";
        else
            $gender = "MALE";

        if (isset($_POST['city'])) $city_name = $_POST['city'];
        if (isset($_POST['city_id'])) $city_id = $_POST['city_id'];
        if (isset($_POST['campuses'])) $campus_code = $_POST['campuses'];
        if (isset($_POST['classes'])) $classId = $_POST['classes'];
        require_once('./dbconnection.php');
        $query = $link->query("SELECT id FROM campus_classes WHERE class_id = $classId AND  campus_code= '$campus_code'");
        $class_row = mysqli_fetch_object($query);
        $class_id = $class_row->id;

        if (isset($_POST['sessions'])) $session_id = $_POST['sessions'];
        if (isset($_POST['groups'])) $group_id = $_POST['groups'];
        //////////////// for student ACADEMIC INFORMATION/////////////////////////
        if (isset($_POST['class_passed'])) $class_passed = $_POST['class_passed'];
        if (isset($_POST['class_status'])) $class_status = $_POST['class_status'];
        if (isset($_POST['roll_number'])) $roll_number = $_POST['roll_number'];
        if (isset($_POST['examination_board'])) $examination_board = $_POST['examination_board'];
        if (isset($_POST['marks_obtained'])) $marks_obtained = $_POST['marks_obtained'];
        ///////////////////////////
        $campus_code = addslashes($campus_code);
        $city_id = addslashes($city_id);
        $session_id = addslashes($session_id);
        $class_id = addslashes($class_id);
        $group_id = addslashes($group_id);
        $student_name = addslashes($student_name);
        $gender = addslashes($gender);
        $city_name = addslashes($city_name);

        $email_address = addslashes($email_address);
        $cnic = addslashes($cnic);
        $class_passed = addslashes($class_passed);
        $class_status = addslashes($class_status);
        $roll_number = addslashes($roll_number);
        $examination_board = addslashes($examination_board);
        $marks_obtained = addslashes($marks_obtained);

        $created_at = date('Y-m-d H:i:s');
        $form_submission_date = date('Y-m-d');
        $pin_code = generateRandomString(6);
        include('dbconnection.php');
        $sql_roll_no = "SELECT MAX(roll_no) as last_roll_no From admissions_ec where campus_code = '$campus_code' AND session_id = '$session_id'";
        $roll_no_sql = $link->query($sql_roll_no);
        $roll_no = mysqli_fetch_array($roll_no_sql);
        $roll_no = $roll_no["last_roll_no"] + 1;
        $registration_number = $campus_code . "-" . $class_id . "-" . $session_id . "-" . $roll_no;

        $strSQL = "insert into admissions_ec set
    campus_code = '$campus_code',
    registration_number = '$registration_number',
    class_id = '$class_id',
    session_id = '$session_id',
    class_group_id = '$group_id',
    student_name = UPPER('$student_name'),
    gender = '$gender',
    permanent_city = '$city_name',
    cellphone = '$cellphone_number',
    email = '$email_address',
    cnic = '$cnic',
    roll_no = '$roll_no',
    admission_source = 'online',
    user_pin = '$pin_code',
    status = 'Active',
    form_submission_date = '$form_submission_date',
    created_at = '$created_at' ";


        if ($link->query($strSQL) === TRUE) {
            $receipt_no = $link->insert_id;
            $student_history_sql = "insert into student_history set
            student_id = '$receipt_no',
            student_registration_no = '$registration_number',
           campus_code = '$campus_code',
           campus_class_id = '$class_id',
           session_id = '$session_id',
           class_group_id = '$group_id',
           student_rollno = '$roll_no', 
            created_at = '$created_at',
            user_id = '1',
            status='admission'";
            $link->query($student_history_sql);


            $sql_session_fee = "SELECT * From session_fee where campus_code = '$campus_code' AND session_id = '$session_id' AND status = 'Active'";
            $session_fee_sql = $link->query($sql_session_fee);
            while ($session_fee = mysqli_fetch_array($session_fee_sql)) {
                $session = $session_fee["session_id"];
                $fee_code = $session_fee["fee_code"];
                $fee = $session_fee["fee"];
                $student_fee_sql = "insert into student_fee_detail set
            student_id = '$receipt_no',
            session_id = '$session',
            fee_code = '$fee_code',
            fee_default = '$fee',
            fee_standard= '$fee',
            fee_offered= '$fee',
            created_at = '$created_at',
            user_id = '1',
            status='Active'";
                $link->query($student_fee_sql);
            }
            $sql_sub = "SELECT * From subjects where group_id = '$group_id' AND status = 'Active'";
            $sub_sql = $link->query($sql_sub);

            while ($subject_detail = mysqli_fetch_array($sub_sql)) {
                $subject = $subject_detail["subject"];

                $subject_detail_insert = "insert into std_subject_detail set
                admission_id = '$receipt_no',
                subject = '$subject',
                added_at = '$created_at',
                status='Active'";
                $link->query($subject_detail_insert);
            }


            $sql = "insert into acadamic_info set
        student_id = '$receipt_no',
        academic_qualification_board = '$examination_board',
        academic_qualification_level = '$class_passed',
        academic_qualification_rollnumber = '$roll_number',
        academic_qualification_obtmarks= '$marks_obtained',
        class_status = '$class_status'";
            $link->query($sql);

        }

        $classsql = "SELECT
classes.class_name
FROM
campus_classes
INNER JOIN classes ON campus_classes.class_id = classes.id
WHERE campus_classes.id = '$class_id'";
        $classquery = mysqli_query($link, $classsql);
        $classresult = mysqli_fetch_array($classquery);
        $classname = $classresult["class_name"];

        $campussql = "SELECT
campuses.address
FROM
campuses

WHERE campus_code = '$campus_code'";
        $campusquery = mysqli_query($link, $campussql);
        $campusresult = mysqli_fetch_array($campusquery);
        $campusname = $campusresult["address"];
        $campusnamelength = strlen($campusname);

        $sessionsql = "SELECT
sessions.sessions_title
FROM
sessions
WHERE id='$session_id'";
        $sessiomquery = mysqli_query($link, $sessionsql);
        $sessionresult = mysqli_fetch_array($sessiomquery);
        $sessionname = $sessionresult["sessions_title"];

        $subsql = "SELECT subject_fee_code FROM application_settings";
        $query = mysqli_query($link, $subsql);
        $result = mysqli_fetch_array($query);
        $subject_fee_code = $result["subject_fee_code"];
        $sql = "SELECT
        session_fee.fee,
        fee_codes.fee_title,
        fee_codes.fee_frequency,
        fee_codes.fee_type,
        fee_codes.id,
        fee_codes.discountable
        FROM
        session_fee
        INNER JOIN fee_codes ON session_fee.fee_code = fee_codes.id
        where session_id = '$session_id' AND session_fee.status='Active' AND fee_code != '$subject_fee_code' AND campus_code = '$campus_code'";
        $result = mysqli_query($link, $sql);

        $title0 = '';
        $title1 = '';
        $title2 = '';
        $fee0 = 0;
        $fee1 = 0;
        $fee2 = 0;
        $totalfee = 0;
        $totalfeewords = '';

        while ($row[] = mysqli_fetch_array($result)) ;
        //  print_r($row);
        if (isset($row[0]['fee_title'])) {
            $title0 = $row[0]['fee_title'];
            $fee0 = $row[0]['fee'];
            $totalfee = $fee0;
        }
        if (isset($row[1]['fee_title'])) {
            $title = " Entry Test Fee ";
            $fee1 = $row[1]['fee'];
            $fee = $fee1;
            $totalfee = $fee0 + $fee1;
        }

        $totalfeewords = strtoupper(convert_number_to_words($totalfee) . " Only");

    }
}
function convert_number_to_words($number)
{

    $hyphen = '-';
    $conjunction = ' and ';
    $separator = ', ';
    $negative = 'negative ';
    $decimal = ' point ';
    $dictionary = array(
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        20 => 'twenty',
        30 => 'thirty',
        40 => 'fourty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety',
        100 => 'hundred',
        1000 => 'thousand',
        1000000 => 'million',
        1000000000 => 'billion',
        1000000000000 => 'trillion',
        1000000000000000 => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens = ((int)($number / 10)) * 10;
            $units = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int)($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string)$fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
//include('header-nested.php');

function generateRandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$kips_code = "0092";
$type_id = "2";
$years_month = date("ym");
$bank_watcher_no = $kips_code . "0" . $type_id . "0" . $receipt_no . "0" . $years_month;
$Consumer_Detail = $student_name;
$ConsumerNumber = $bank_watcher_no;
/////////////////////////////   update record in voucher table///////////////
$Billing_Month = date("Y-m");

$due_date = date('Y-m-d', strtotime('+3 days'));
//////////////////////////////
$Consumer_Detail = (strlen($Consumer_Detail) > 30) ? substr($Consumer_Detail, 0, 30) : $Consumer_Detail;
/////////////////////////////
$result = $link->query("SELECT VoucherNumber FROM kpay_vouchers WHERE VoucherNumber = '$bank_watcher_no'");
////////////////////////////////////// start of insert record query
if ($result->num_rows == 0) {
    $strSQL = "INSERT INTO kpay_vouchers SET
                    VoucherNumber  = '$bank_watcher_no',
                    student_id  = '$receipt_no',
                    ConsumerNumber  = '$ConsumerNumber',
                    Consumer_Detail  = UPPER('$student_name'),
                    Due_Date  = '$due_date',
                    Date_Paid  = '$due_date',
                    Amount_Within_DueDate  = '$totalfee',
                    Amount_After_DueDate  = '$totalfee',
                    Billing_Month  = '$Billing_Month',
                    Bill_Status = 'U'";
    if ($link->query($strSQL) === TRUE) {
        $record_save_message = "<h2>Application Submitted Successfully</h2>";
    } else {
        $record_save_message = "<h2>Error: " . $strSQL . "<br>" . $link->error . "<h2>";
    }
    include('fee_proceed.php');



}

/// /////////////////////
include("ajax_sms.php");
if ($cellphone_number != '') {
    $cellphone = explode(" ", $cellphone_number);
    $num = explode("-", $cellphone[1]);
    $cellphone = '92' . $num[0] . $num[1];
    $smstext = 'Welcome To KIPS. Please use Voucher ' . $bank_watcher_no . ' to submit your fee online via kuickpay, for details visit www.kuickpay.com. After confirmation LMS account detail will be shared on session start date.';
    $mobile = formatMobileNo($cellphone_number);
    ////sendsms($ping->data, $mobile, $smstext, 'KIPS PREPS');
}

?>
