<?php
require_once './dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();
ob_start();
?>
<html>
<link rel="stylesheet" type="text/css" href="css/voucher.css">
<body style="margin: 0;">
<div id="p1" style="overflow: hidden; position: relative; width: 1540px; height: 835px;">

    <div class="fixed1"><img src="img/kips.bmp" width="57"/></div>
    <div id="t1_1" class="t s1_1">A Project of KIPS Preparations (pvt) LTD</div>
    <div id="t7_2" class="t s3_1">On Account of KUICKPAY</div>
    <div class="fixed2"><img src="img/kips.bmp" width="57"/></div>
    <div id="t2_1" class="t s1_1">A Project of KIPS Preparations (pvt) LTD</div>
    <div id="t8_2" class="t s3_1">On Account of KUICKPAY</div>
    <div class="fixed3"><img src="img/kips.bmp" width="57"/></div>
    <div id="t3_1" class="t s1_1">A Project of KIPS Preparations (pvt) LTD</div>
    <div id="t9_2" class="t s3_1">On Account of KUICKPAY</div>
    <div id="ta_1" class="t s3_1">Bank Challan No.</div>
    <div id="ta_2" class="t s3_1b"><b><?php echo $bank_watcher_no; ?></b></div>
    <div id="tb_1" class="t s3_1">Date:</div>
    <div id="tc_1" class="t s4_1"><?php echo date("d-m-Y"); ?></div>
    <div id="td_1" class="t s3_1">Bank Challan No.</div>
    <div id="td_2" class="t s3_1b"><b><?php echo $bank_watcher_no; ?></b></div>
    <div id="te_1" class="t s3_1">Date:</div>
    <div id="tf_1" class="t s4_1"><?php echo date("d-m-Y"); ?></div>
    <div id="tg_1" class="t s3_1">Bank Challan No.</div>
    <div id="tg_2" class="t s3_1b"><b><?php echo $bank_watcher_no; ?></b></div>
    <div id="th_1" class="t s3_1">Date:</div>
    <div id="ti_1" class="t s4_1"><?php echo date("d-m-Y"); ?></div>
    <div id="tj_1" class="t s3_1">Name:</div>
    <div id="tk_1" class="t s4_1" style="text-transform: uppercase"><?php echo $student_name; ?></div>
    <div id="tl_1" class="t s3_1">Name:</div>
    <div id="tm_1" class="t s4_1" style="text-transform: uppercase"><?php echo $student_name; ?></div>
    <div id="tn_1" class="t s3_1">Name:</div>
    <div id="to_1" class="t s4_1" style="text-transform: uppercase"><?php echo $student_name; ?></div>
    <div id="tp_1" class="t s3_1">Class/Course:</div>
    <div id="tq_1" class="t s4_1"><?php echo $classname; ?></div>
    <div id="tr_1" class="t s3_1">Class/Course:</div>
    <div id="ts_1" class="t s4_1"><?php echo $classname; ?></div>
    <div id="tt_1" class="t s3_1">Class/Course:</div>
    <div id="tu_1" class="t s4_1"><?php echo $classname; ?></div>
    <div id="tv_1" class="t s3_1">Campus:</div>
    <div id="tw_1" class="t s4_1 <?php if ($campusnamelength > 43) {
        echo 'wrap';
    } ?>"><?php echo $campusname ?></div>
    <div id="tx_1" class="t s3_1">Campus:</div>
    <div id="ty_1" class="t s4_1 <?php if ($campusnamelength > 43) {
        echo 'wrap';
    } ?>"><?php echo $campusname ?></div>
    <div id="tz_1" class="t s3_1">Campus:</div>
    <div id="t10_1" class="t s4_1 <?php if ($campusnamelength > 43) {
        echo 'wrap';
    } ?>"><?php echo $campusname ?></div>
    <div id="t11_1" class="t s3_1">Session:</div>
    <div id="t12_1" class="t s4_1"><?php echo $sessionname ?></div>
    <div id="t13_1" class="t s3_1">Session:</div>
    <div id="t14_1" class="t s4_1"><?php echo $sessionname ?></div>
    <div id="t15_1" class="t s3_1">Session:</div>
    <div id="t16_1" class="t s4_1"><?php echo $sessionname ?></div>
    <div id="t17_1" class="t s3_1">&nbsp;</div>
    <div id="t18_1" class="t s4_1">&nbsp;</div>
    <div id="t19_1" class="t s3_1">Last Date:</div>
    <div id="t1a_1" class="t s4_1"><?php echo date("d-m-Y", strtotime(date("m/d/Y") . "+3 days")); ?></div>
    <div id="t1b_1" class="t s3_1">&nbsp;</div>
    <div id="t1c_1" class="t s4_1">&nbsp;</div>
    <div id="t1d_1" class="t s3_1">Last Date:</div>
    <div id="t1e_1" class="t s4_1"><?php echo date("d-m-Y", strtotime(date("m/d/Y") . "+3 days")); ?></div>
    <div id="t1f_1" class="t s3_1">&nbsp;</div>
    <div id="t1g_1" class="t s4_1">&nbsp;</div>
    <div id="t1h_1" class="t s3_1">Last Date:</div>
    <div id="t1i_1" class="t s4_1"><?php echo date("d-m-Y", strtotime(date("m/d/Y") . "+3 days")); ?></div>
    <div id="t1j_1" class="t s3_1table"  style="width:550px">
            <table>
                <tr>
                    <th colspan="2">   P  A  R  T  I  C  U  L  A  R  S                   </th>
                    <th> AMOUNT </th>
                </tr>

                <tr>
                    <td colspan="2" style=" text-align: right;">TOTAL FEE</td>
                    <td class="td_num"><?php echo $totalfee; ?>.00</td>

                </tr>
            </table>
        </div>
    <div id="t1l_1" class="t s3_1table"  style="width:100%">
        <table  style="width:100%">
            <tr>
                <th colspan="2">   P  A  R  T  I  C  U  L  A  R  S                   </th>
                <th> AMOUNT </th>
            </tr>

            <tr>
                <td colspan="2" style=" text-align: right;">TOTAL FEE</td>
                <td class="td_num"><?php echo $totalfee; ?>.00</td>

            </tr>
        </table>
    </div>
    <div id="t1n_1" class="t s3_1table" >
        <table style="width:100%">
            <tr>
                <th colspan="2">   P  A  R  T  I  C  U  L  A  R  S                   </th>
                <th> AMOUNT </th>
            </tr>
            <tr>
                <td colspan="2" style=" text-align: right;">TOTAL FEE</td>
                <td class="td_num"><?php echo $totalfee; ?>.00</td>

            </tr>
        </table>
    </div>

    <div id="t2y_1" class="t s5_1">Rupees:</div>
    <div id="t2z_1" class="t s4_1"><?php echo $totalfeewords; ?></div>
    <div id="t30_1" class="t s5_1">Rupees:</div>
    <div id="t31_1" class="t s4_1"><?php echo $totalfeewords; ?></div>
    <div id="t32_1" class="t s5_1">Rupees:</div>
    <div id="t33_1" class="t s4_1"><?php echo $totalfeewords; ?></div>
    <div id="t34_1" class="t s6_1">PAYMENT TERMS:</div>
    <div id="t35_1" class="t s6_1">PAYMENT TERMS:</div>
    <div id="t36_1" class="t s6_1">PAYMENT TERMS:</div>
    <div id="t37_1" class="t s7_1">1.</div>
    <div id="t38_1" class="t s7_1">The challan can be paid via digital channels (ATM/Internet/Mobile banking) using
        'kuickpay' biller under 'Bill Payment' option of these banks (Bank Alfalah, Faysal Bank,
        Meezan Bank, Askari  Bank, Soneri Bank, BankIslami, Habib Metropolitan, JS Bank,
        BOP, Summit Bank, Samba Bank, NRSP Bank, FMBL).
    </div>
    <div id="t39_1" class="t s7_1">1.</div>
    <div id="t3a_1" class="t s7_1">The challan can be paid via digital channels (ATM/Internet/Mobile banking) using
        'kuickpay' biller under 'Bill Payment' option of these banks (Bank Alfalah, Faysal Bank,
        Meezan Bank, Askari Bank, Soneri Bank, BankIslami, Habib Metropolitan, JS Bank,
        BOP, Summit Bank, Samba Bank, NRSP Bank, FMBL).
    </div>
    <div id="t3b_1" class="t s7_1">1.</div>
    <div id="t3c_1" class="t s7_1">The challan can be paid via digital channels (ATM/Internet/Mobile banking) using
        'kuickpay' biller under 'Bill Payment' option of these banks (Bank Alfalah, Faysal Bank,
        Meezan Bank, Askari  Bank, Soneri Bank, BankIslami, Habib Metropolitan, JS Bank,
        BOP, Summit Bank, Samba Bank, NRSP Bank, FMBL).
    </div>
    <div id="t3g_1" class="t s7_1">2.</div>
    <div id="t3h_1" class="t s7_1">The challan can also be paid at any branch counter of Meezan Bank or at TCS.</div>
    <div id="t3i_1" class="t s7_1">2.</div>
    <div id="t3j_1" class="t s7_1">The challan can also be paid at any branch counter of Meezan Bank or at TCS.</div>
    <div id="t3k_1" class="t s7_1">2.</div>
    <div id="t3l_1" class="t s7_1">The challan can also be paid at any branch counter of Meezan Bank or at TCS.</div>
    <div id="t3m_1" class="t s7_1">3.</div>
    <div id="t3n_1" class="t s7_1">For more details visit kuickpay website (www.kuickpay.com).</div>
    <div id="t3o_1" class="t s7_1">3.</div>
    <div id="t3p_1" class="t s7_1">For more details visit kuickpay website (www.kuickpay.com).</div>
    <div id="t3q_1" class="t s7_1">3.</div>
    <div id="t3r_1" class="t s7_1">For more details visit kuickpay website (www.kuickpay.com).</div>
    <div id="t4g_1" class="t s3_1">Bank's Signature</div>
    <div id="t4h_1" class="t s3_1">Bank's Signature</div>
    <div id="t4i_1" class="t s3_1">Bank's Signature</div>
    <div id="t4j_1" class="t s8_1">Student's Copy</div>
    <div id="t4l_1" class="t s8_1">Bank's Copy</div>
    <div id="t4n_1" class="t s8_1">KIPS' Copy</div>
   <div id="pg1Overlay"
   style="width:100%; height:100%; position:absolute; z-index:1; background-color:rgba(0,0,0,0); -webkit-user-select: none;"></div>
</div>
</body>
</html>
<?php
$html = ob_get_clean();
//$filename = "bankVoucher";
$dompdf->loadHtml($html);
//$dompdf->setPaper('A2', 'portrait');
$dompdf->setPaper('A3', 'landscape');
$dompdf->render();
$dompdf->stream($student_name);

?>

