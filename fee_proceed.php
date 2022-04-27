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
    <script type="text/javascript" src="js/jquery.redirect.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="row">
<div class="col-md-2 logo-div">
    <img class="logo-img" src="img/KET.png">
</div>
    <form id="hidden_form" action="process_voucher_print.php" method="post" target="_blank">
    <input type="hidden" name="student_name" value="<?=$student_name?>">
    <input type="hidden" name="classname" value="<?=$classname?>">
    <input type="hidden" name="campusname" value="<?=$campusname?>">
    <input type="hidden" name="sessionname" value="<?=$sessionname?>">
    <input type="hidden" name="totalfee" value="<?=$totalfee?>">
    <input type="hidden" name="totalfeewords" value="<?=$totalfeewords?>">
    <input type="hidden" name="bank_watcher_no" id="bank_watcher_no" value="<?=$bank_watcher_no?>">

<div class="col-md-9">
<nav class="navbar navbar-inverse">
    <div class="heading-div col-md-7 col-sm-7">
        <h3 style="font-size: 30px;font-weight: bolder">Payment Option</h3>
        <h5 class="heading-down">STUDENT ADMISSION FORM</h5>
    </div>
</nav>
</div>
</div>
<div class="row" style="padding-top: 100px">
    <div class="col-md-2" style="margin-left: 2.7%;"></div>
    <div class="col-md-9">
        <div class="col-md-6">
        <h4>Challan No :</h4>
        <h2><input type="text" value="<?=$bank_watcher_no?>" id="voucherNumber" readonly style="border: none;background-color: transparent;"><a onclick="copyVoucher();" class="link"><i class="fa fa-copy copyIcon" ></i></a></h2>

            <div class="form-group col-sm-12 btn-div">
                <button type="button" class="btn btn-primary btn-lg" style="width: auto" id="btn_id">Pay Online &nbsp;&nbsp;&nbsp;&nbsp;</button><br><br>
                <button type="submit" class="btn btn-primary btn-lg" style="width: auto">Save Challan</button>
            </div>
<p>Save your Challan and visit</p>
<h4><b>Your Nearest KIPS Campus</b></h4>
            <div>
                <img src="img/campus.png" >
            </div><br>
            <h4><b>or any of the outlet mention below</b></h4>
            <div class="col-md-2 ">
                <img src="img/meezan.png" >
            </div>
            <div class="col-md-2">
                <img src="img/tcs.png" width="100">
            </div>
            <div class="col-md-2">
                <img src="img/ubl.png" >
            </div>
    </div>
        </form>
        <div class="col-md-6 fee-voucher" style="margin-bottom: 5%">
                <div class="col-md-12">
                    <div class="col-md-2">
                    <img width="110" class="text-left" src="img/KET.png">
                </div>
                    <div class="col-md-9 pt-4">
                        <h4 class="text-center text-black">A Project of KIPS Preparations (pvt) LTD</h4>
                        <p class="text-center">On Account of KUICKPAY</p>
                        <p class="text-center">UAN:042-111-547-775</p>
                    </div>
                </div>
            <div class="col-md-12">
                <div class="col-md-8 pt-4">
                    <h5 class="text-left">Bank Challan NO. <strong class="text-black"><?=$bank_watcher_no?></strong></h5>
                </div>
                <div class="col-md-4 pt-4">
                <div class="col-sm-4">
                    <p class="text-left">Date.</p>
                </div>
                <div class="col-sm-8">
                   <p class="text-right"><?php echo date("d-m-Y")?></p>
                </div>
                </div>
            </div>

            <div class="col-md-12">
                    <div class="col-sm-2">
                        <p class="text-left">Name:</p>
                    </div>
                    <div class="col-sm-4">
                        <p class="text-left"><?=$student_name?></p>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-sm-2">
                    <p class="text-left">Class:</p>
                </div>
                <div class="col-sm-4">
                    <p class="text-left"><?=$classname?></p>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-sm-2">
                    <p class="text-left">Campus:</p>
                </div>
                <div class="col-sm-4">
                    <p class="text-left"><?=$campusname?></p>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-sm-2">
                    <p class="text-left">Session:</p>
                </div>
                <div class="col-sm-4">
                    <p class="text-left"><?=$sessionname?></p>
                </div>
            </div>

            <div class="col-md-12">
                <div class="col-sm-9">
                    <p class="text-right">Last Date:</p>
                </div>
                <div class="col-sm-3">
                    <p class="text-right"><?php echo date("d-m-Y", strtotime(' +3 day'))?></p>
                </div>
            </div>
            <div class="col-md-12 pt-2">
               <table class="table table-bordered">
                   <thead class="text-black text-center bold">
                   <tr>
                       <td  style="width: 75%">P A R T I C U L A R S</td>
                       <td style="width: 25%">AMOUNT</td>
                   </tr>
                   </thead>
                   <tbody class="text-right">
                   <tr>
                       <td>Total Fee</td>
                       <td><?=$totalfee?></td>
                   </tr>
                   </tbody>
               </table>
            </div>
            <div class="col-md-12 pt-4">
                <div class="col-sm-2">
                    <p class="text-left bold">Rupees:</p>
                </div>
                <div class="col-sm-8">
                    <p class="text-left"><?=$totalfeewords?>.</p>
                </div>
            </div>
            <div class="col-md-12 pt-2">
                <div class="col-sm-5">
                    <h4 class="text-left bold">Payment Terms:</h4>
                </div>
            </div>
            <div class="col-md-12 pt-2">
                <div class="col-sm-12" style="font-size: 13px">
                    <ul>
                        <li>The Challan can be paid via digital channels (ATM/Internet/Mobile banking) using
                        "KUICKPAY" biller under "Bill Payment" option of these banks(Bank Alfalah,Faysal Bank,Meezan Bank,Askari Bank,Soneri Bank,Bank Islami,
                            Habib Metropulitan,JS Bank,Bank of Punjab,Summit Bank,Samba Bank,NRSP Bank,FMBL).
                        </li>
                        <li>The Challan can also be paid any branch counter of Meezan Bank or at TCS</li>
                        <li>
                            For more detail visit kuickpay website(www.kuickpay.com).
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12 pt-2">
                <div class="col-sm-10">
                    <h5 class="text-right bold">Bank`s Signature</h5>
                </div>
            </div>
            <div class="col-md-12 pt-2">
                <div class="col-sm-5">
                    <h4 class="text-left bold">Student Copy</h4>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>
    $("#btn_id").click(function(){
        let bank_watcher_no = $('#bank_watcher_no').val();
        $.redirect('payment_method.php',{
            bank_watcher_no: bank_watcher_no,
        });
    });




</script>

