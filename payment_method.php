<?php
session_start();
if (isset($_SESSION['payment_method_check']) && $_SESSION['payment_method_check'] == 'yes_post_$') {
    $session_value = 'true';

    $_SESSION['payment_method_check'] = '';

if (isset($_POST['bank_watcher_no'])) $bank_watcher_no = $_POST['bank_watcher_no'];
?>
<html lang="en">
<head>
    <title>Online Admission Forms</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='fonts/poppins.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
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
        <h3 style="font-size: 30px;font-weight: bolder">Payment Option</h3>
        <h5 class="heading-down">STUDENT ADMISSION FORM</h5>
    </div>
</nav>
</div>
</div>
<div class="row" style="padding-top: 50px">
    <div class="col-md-2" style="margin-left: 2.7%;"></div>
    <div class="col-md-9">
        <div class="col-md-6">
            <p><strong class="text-red">Step 01 : </strong>Copy your challan number.</p>
        <h4 class="bold"><input type="text" value="<?=$bank_watcher_no?>" id="voucherNumber" readonly style="border: none;background-color: transparent;"><a onclick="copyVoucher();" class="link"><i class="fa fa-copy copyIcon" ></i></a></h4>
    </div>
    </div>
</div>
<div class="row" style="padding-top: 50px">
    <div class="col-md-2" style="margin-left: 2.7%;"></div>
    <div class="col-md-9">
        <div class="col-md-6">
            <p><strong class="text-red">Step 02 : </strong>Login to your Bank`s internet banking / mobile banking or visit nearest ATM.</p>
            <p style="font-size: 12px">Click on the icons below to watch demo video.</p>

        </div>
        <div class="col-md-12">
            <div class="col-md-2">
                <div class="payment-icons text-center">
                    <img src="img/surface1.png" class="payment-img" href="#">
                </div>
                <p class="pt-1">Debit/Credit Card</p>
            </div>
            <div class="col-md-2">
                <div class="payment-icons text-center">
                    <img src="img/cashless-payment.png" class="payment-img" href="#">
                </div>
                <p class="pt-1">Mobile Banking</p>
            </div>
            <div class="col-md-2">
                <div class="payment-icons text-center">
                    <img src="img/online-banking.png" class="payment-img" href="#">
                </div>
                <p class="pt-1">Internet Banking</p>
            </div> <div class="col-md-2">
                <div class="payment-icons text-center">
                    <img src="img/atm-machine.png" class="payment-img" href="#">
                </div>
                <p class="pt-1">ATM</p>
            </div>
            <div class="col-md-2">
                <div class="payment-icons text-center">
                    <img src="img/Easypaisa_logo.png" class="payment-img" href="#">
                </div>
                <p class="pt-1">Easy Paisa</p>
            </div> <div class="col-md-2">
                <div class="payment-icons text-center">
                    <img src="img/jcash.png" class="payment-img" href="#">
                </div>
                <p class="pt-1">JazzCash</p>
            </div>

        </div>
        </div>
    </div>
<div class="row" style="padding-top: 50px">
    <div class="col-md-2" style="margin-left: 2.7%;"></div>
    <div class="col-md-9">
        <div class="col-md-6">
            <p><strong class="text-red">Step 03 : </strong>Select the KUICKPAY in the Bill Payment Menu.</p>
        </div>
        <div class="col-md-12">
            <div class="col-md-2" style="background-color: white;height: 50px;border-radius: 3px;box-shadow: 0px 10px 10px -7px rgba(0, 0, 0, 0.3);">
                    <img src="img/kuickpay-new.png" href="#" height="45">
            </div>
        </div>
    </div>
</div>
<div class="row" style="padding-top: 50px">
    <div class="col-md-2" style="margin-left: 2.7%;"></div>
    <div class="col-md-9">
        <div class="col-md-6">
            <p><strong class="text-red">Step 04 : </strong>Enter your Challan Number and pay your fee.</p>
        </div>
        <div class="col-md-12">
            <div class="col-md-2">
                <div class="payment-icons text-center">
                <img src="img/successful.png" class="payment-img" href="#">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="padding-top: 50px">
    <div class="col-md-2" style="margin-left: 2.7%;"></div>
    <div class="col-md-9">
        <div class="col-md-6">
            <p><strong class="text-red"><i class="fa fa-star"></i> </strong> KUICKPAY is enabled for online transaction on following banks.</p>
        </div>
        <div class="col-md-12">
            <div class="col-md-2">

                    <img src="img/bank-groups.png" href="#">
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
}else {
    echo "<h2>Your Browser Session is Expired, Please try again. <a href='/'>Reload Page</a></h2>";
    exit();
}
?>

