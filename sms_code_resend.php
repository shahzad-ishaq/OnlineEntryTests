<?php
include("ajax_sms.php");
if (isset($_POST['last_id']))  $last_id = $_POST['last_id'];
if (isset($_POST['cellphone_number']))  $cellphone_number = $_POST['cellphone_number'];
$rendem_num = sprintf("%06d", mt_rand(1, 999999));
print_r($rendem_num);
include('dbconnection.php');
 $sql = "UPDATE online_admissions SET authentication_code = '$rendem_num' WHERE id='$last_id'";
if ($link->query($sql) === TRUE) {
    $message = smsText($rendem_num);
    $mobile = formatMobileNo($cellphone_number);
    sendsms($mobile, $message, 'KIPS PREPS');
    echo json_encode([]);
} else {
}

?>