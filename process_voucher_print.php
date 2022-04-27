<?php
ob_start();
date_default_timezone_set('Asia/Karachi');

    include('dbconnection.php');
    if (isset($_POST['bank_watcher_no'])) $bank_watcher_no = $_POST['bank_watcher_no'];
    if (isset($_POST['student_name'])) $student_name = $_POST['student_name'];
    if (isset($_POST['classname'])) $classname = $_POST['classname'];
    if (isset($_POST['campusname'])) $campusname = $_POST['campusname'];
    if (isset($_POST['sessionname'])) $sessionname = $_POST['sessionname'];
    if (isset($_POST['totalfee'])) $totalfee = $_POST['totalfee'];
    if (isset($_POST['totalfeewords'])) $totalfeewords = $_POST['totalfeewords'];
    $result = $link->query("SELECT kv.* FROM kpay_vouchers WHERE VoucherNumber = '$bank_watcher_no'");
    if ($result->num_rows == 0) {
        include('bank_voucher.php');
    }

////////////////////////

?>
