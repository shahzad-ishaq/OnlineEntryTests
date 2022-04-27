<?php

$link = mysqli_connect('localhost', 'root', '', 'production');
//$link = mysqli_connect('kipsrdsnew.clboc0xjvbaa.us-east-1.rds.amazonaws.com', 'kips_rds_admin', 'Kips$Admin$', 'kips_production');
///$link = mysqli_connect('kips-productiondb.clboc0xjvbaa.us-east-1.rds.amazonaws.com', 'kips_rds_admin', 'Kips$Admin$', 'kips_production');

if (!$link) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

mysqli_get_host_info($link);

?>
