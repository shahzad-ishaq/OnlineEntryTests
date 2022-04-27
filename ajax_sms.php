<?php
ini_set('max_execution_time', 99999);
date_default_timezone_set('Asia/Karachi');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = '{
    "data": "as435278sgfe7streqahfufndadshdfz"}';

    $ping = json_decode($json);

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


    function sendsms($fazol,$cell_string, $smstext, $mask)
    {
        $masking = preg_replace('/\s+/', '', $mask);
        $url_space = "http://api.bizsms.pk/web-ported-to-sms.aspx?username=kips@bizsms.pk&pass=k1p3sm3&text=" . $smstext . "&masking=".$masking."&destinationnum=$cell_string"."&language=English";
        $url = str_replace(" ","%20",$url_space);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);

        curl_close($ch);
        return $output;
    }
}



