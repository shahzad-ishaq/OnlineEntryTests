<?php
ini_set('max_execution_time', 99999);
date_default_timezone_set('Asia/Karachi');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    function smsText($voucherNumber)
    {
        return "Verify Code $voucherNumber";
    }

    function formatMobileNo($mobile_no)
    {
        $num = explode(" ", $mobile_no);
        $num1 = explode("-", $num[1]);
        return '92' . $num1[0] . $num1[1];
    }



    function sendsms($api_session, $cell_string, $smstext, $mask)
    {
        $url = "https://telenorcsms.com.pk:27677/corporate_sms2/api/sendsms.jsp";
        $post_string2 = "session_id=" . $api_session . "&to=" . $cell_string . "&text=" . $smstext . "&mask=" . $mask;

        $curl_connection = curl_init();
        //set options
        curl_setopt($curl_connection, CURLOPT_URL, $url);
        curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($curl_connection, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 6.0; Windows NT 5.1)");
        curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_connection, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);
        //set data to be posted
        curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string2);
        $result = curl_exec($curl_connection);
        $xml = simplexml_load_string($result) or die("Error: Cannot create object");
        curl_close($curl_connection);
    }

    function getTelenorSession($post_string)
    {
        $url = "https://telenorcsms.com.pk:27677/corporate_sms2/api/auth.jsp";
        //create cURL connection
        $curl_connection = curl_init();
        //set options
        curl_setopt($curl_connection, CURLOPT_URL, $url);
        curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, True);
        curl_setopt($curl_connection, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, False);
        curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl_connection, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 0);
        //set data to be posted
        curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);
        //perform our request
        $result = curl_exec($curl_connection);
        $json = simplexml_load_string($result);// or die(curl_error($curl_connection));
        curl_getinfo($curl_connection);
        return $json;

    }

    function ping($session_id)
    {
        $post_string = "session_id=$session_id";

        $curl_connection = curl_init();
        curl_setopt($curl_connection, CURLOPT_URL, "https://telenorcsms.com.pk:27677/corporate_sms2/api/ping.jsp");
        curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, True);
        curl_setopt($curl_connection, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, False);
        curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl_connection, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);
        //perform our request
        $result = curl_exec($curl_connection);
        $json = simplexml_load_string($result);// or die(curl_error($curl_connection));
        curl_getinfo($curl_connection);
        return $json;
    }
//////////////////////////////////for get the data of student with voucher-number ///////////////////////////

    $smsSession = getTelenorSession("msisdn=923408444361&password=it.mis.preps");
    $ping = ping($smsSession->data);
}