<?php

    if (isset($_POST['student_name'])) {
    if (isset($_POST['student_name'])) $student_name = $_POST['student_name'];
    if (isset($_POST['cellphone_number'])) $cellphone_number = $_POST['cellphone_number'];
    if (isset($_POST['email_address'])) $email_address = $_POST['email_address'];
    if (isset($_POST['cnic'])) $cnic = $_POST['cnic'];

    if (isset($_POST['code1'])) $code1 = $_POST['code1'];
    if (isset($_POST['code2'])) $code2 = $_POST['code2'];
    if (isset($_POST['code3'])) $code3 = $_POST['code3'];
    if (isset($_POST['code4'])) $code4 = $_POST['code4'];
    if (isset($_POST['code5'])) $code5 = $_POST['code5'];
    if (isset($_POST['code6'])) $code6 = $_POST['code6'];
    //print_r($code1.$code2.$code3.$code4.$code5.$code6);
    include('dbconnection.php');

    $authentication_code = $code1.$code2.$code3.$code4.$code5.$code6;
   $sql = "SELECT * FROM online_admissions WHERE
    authentication_code = '$authentication_code' AND student_name = '$student_name'AND
    cellphone = '$cellphone_number' AND email = '$email_address' AND cnic = '$cnic'";
    $query = mysqli_query($link, $sql);
    while ($result = mysqli_fetch_array($query))
    $myJSON = json_encode($result);
    if(isset($myJSON) && !empty($myJSON)) {
        echo $myJSON;
    }else{
        echo "false";
    }
}
?>

