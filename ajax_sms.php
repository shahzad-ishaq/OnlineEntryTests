<?php
ini_set('max_execution_time', 99999);
date_default_timezone_set('Asia/Karachi');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = '{
    "data": "as435278sgfe7streqahfufndadshdfz"}';

    $ping = json_decode($json);

    function smsText($voucherNumber)
    {
        return "KIPS PREPS %0a Verification code for online admission $voucherNumber";
    }

    function formatMobileNo($mobile_no)
    {
        $num = explode(" ", $mobile_no);
        $num1 = explode("-", $num[1]);
        return '92' . $num1[0] . $num1[1];
    }


    function sendsms($cell_no, $smstext, $mask)
    {   $smsChannel=2;
         $url_space = "";
        $url = str_replace(" ", "%20", $url_space);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        saveLog($cell_no, $output, $smsChannel);
    }
    function saveLog($cell_no, $output, $smsChannel)
    {
        $create_date=date("Y-m-d H:i:s",time());
        $smsLoglink = mysqli_connect('');
        $strSQL = "INSERT INTO m3_sms_log SET cell_number='$cell_no',msg_status='$output',sms_channel='$smsChannel',create_date='$create_date'";
        if ($smsLoglink->query($strSQL) === TRUE) {
            if ($output == 0)
                return "SMS Successfully Send";
        }

    }

}



